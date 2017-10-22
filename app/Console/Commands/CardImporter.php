<?php

namespace App\Console\Commands;

use App\Models\Card;
use App\Models\Color;
use App\Models\Rarity;
use App\Models\Set;
use App\Models\Supertype;
use App\Models\Type;
use App\Models\Subtype;
use Carbon\Carbon;
use Chumper\Zipper\Zipper;
use Illuminate\Console\Command;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class CardImporter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:cards';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs the importer to download and parse all MTG JSON cards';


    public $json = [];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $zipFile = fopen(base_path().'/storage/importer/AllSets-x.json.zip', 'w') or die('Problems');
        $client = new Client();
        $request = $client->get('https://mtgjson.com/json/AllSets-x.json.zip', ['save_to' => $zipFile]);

        $zipper = new Zipper();
        $zipper->make(base_path().'/storage/importer/AllSets-x.json.zip')->extractTo(base_path().'/storage/importer/extracted');
        $zipper->close();

        $this->json = json_decode(file_get_contents(base_path().'/storage/importer/extracted/AllSets-x.json'), true);

        $this->setImporter();
        $this->cardImporter();
    }

    /**
     * @param $rarity
     * @return mixed
     */
    public function rarityImport($rarity)
    {
        $row = Rarity::where('name','=',$rarity)->first();
        if($row === null){
            $row = new Rarity();
            $row->name = $rarity;
            $row->save();
            return $row->id;
        }else{
            return $row->id;
        }
    }

    /**
     * @param $card
     * @param $card_id
     */
    public function cardColorImporter($card, $card_id)
    {
        if(isset($card["colors"])){
            foreach($card["colors"] as $color){
                $row = Color::where('name','=',$color)->first();
                if($row === null){
                    $row = new Color();
                    $row->name = $color;
                    $row->save();
                }
                $row->cards()->detach($card_id);
                $row->cards()->attach($card_id);
            }
        }
    }

    /**
     * @param $card
     * @param $card_id
     */
    public function cardSupertypeImporter($card, $card_id)
    {
        if(isset($card["supertypes"])){
            foreach($card["supertypes"] as $supertype){
                $row = Supertype::where('supertype','=',$supertype)->first();
                if($row === null){
                    $row = new Supertype();
                    $row->supertype = $supertype;
                    $row->save();
                }
                $row->cards()->detach($card_id);
                $row->cards()->attach($card_id);
            }
        }
    }

    /**
     * @param $card
     * @param $card_id
     */
    public function cardTypeImporter($card, $card_id)
    {
        if(isset($card["types"])){
            foreach($card["types"] as $type){
                $row = Type::where('type','=',$type)->first();
                if($row === null){
                    $row = new Type();
                    $row->type = $type;
                    $row->save();
                }
                $row->cards()->detach($card_id);
                $row->cards()->attach($card_id);
            }
        }
    }

    /**
     * @param $card
     * @param $card_id
     */
    public function cardSubtypeImporter($card, $card_id)
    {
        if(isset($card["subtypes"])){
            foreach($card["subtypes"] as $subtype){
                $row = Subtype::where('subtype','=',$subtype)->first();
                if($row === null){
                    $row = new Subtype();
                    $row->subtype = $subtype;
                    $row->save();
                }
                $row->cards()->detach($card_id);
                $row->cards()->attach($card_id);
            }
        }
    }

    /**
     * @param $card_id
     * @param $card
     */
    public function updateCardPivots($card_id, $card)
    {
        $this->cardColorImporter($card, $card_id);
        $this->cardSupertypeImporter($card, $card_id);
        $this->cardTypeImporter($card, $card_id);
        $this->cardSubtypeImporter($card, $card_id);
    }


    public function cardImporter()
    {
        $this->info('<---------- Doing Card Imports ---------->');
        foreach($this->json as $set){
            foreach($set["cards"] as $card){
                $row = Card::where('import_id','=',$card["id"])->first();
                if($row === null){
                    $card_id = $this->createNewCard($set, $card);
                    $this->updateCardPivots($card_id, $card);

                    $set = Set::where('name','=',$set["name"])->first();
                    $set->cards()->attach($card_id);
                }else{
                    $card_id = $this->updateExistingCard($row->id, $set, $card);
                    $this->updateCardPivots($card_id, $card);
                }
            }
            $this->info('<----- Imported all cards from '.$set["name"].' ----->');
        }
        $this->info('<---------- Finished Card Imports ---------->');
    }

    /**
     * @param $set
     * @param $card
     * @return mixed
     */
    public function createNewCard($set, $card)
    {
        $row = new Card();
        $row->name = $card["name"];
        $row->image_url = isset($card["multiverseid"]) ? "http://gatherer.wizards.com/Handlers/Image.ashx?multiverseid=".$card["multiverseid"]."&type=card" : null;
        $row->card_url = isset($card["multiverseid"]) ? "http://gatherer.wizards.com/Pages/Card/Details.aspx?multiverseid=".$card["multiverseid"] : null;
        $row->text = isset($card["text"]) ? $card["text"] : null;
        $row->flavor = isset($card["flavor"]) ? $card["flavor"] : null;
        $row->reserved = isset($card["reserved"]);
        $row->artist = $card["artist"];
        $row->rarity_id = $this->rarityImport($card["rarity"]);
        $row->mana_cost = isset($card["manaCost"]) ? $card["manaCost"] : null;
        $row->cmc = isset($card["cmc"]) ? $card["cmc"] : null;
        $row->power = isset($card["power"]) ? $card["power"] : null;
        $row->toughness = isset($card["toughness"]) ? $card["toughness"] : null;
        $row->multiverse_id = isset($card["multiverseid"]) ? $card["multiverseid"] : null;
        $row->import_id = $card["id"];
        $row->timeshifted = isset($card["timeshifted"]);
        $row->release_date = isset($set["releaseDate"]) ? Carbon::parse($set["releaseDate"]) : null;
        $row->json = json_encode($card);

        if(! filter_var($row->power, FILTER_VALIDATE_INT)){
            $row->power = -1;
            $row->exceptional_power = isset($card["power"]) ? $card["power"] : null;
        }

        if(! filter_var($row->toughness, FILTER_VALIDATE_INT)){
            $row->toughness = -1;
            $row->exceptional_toughness = isset($card["toughness"]) ? $card["toughness"] : null;
        }

        $row->save();
        return $row->id;
    }

    /**
     * @param $uuid
     * @param $set
     * @param $card
     * @return mixed
     */
    public function updateExistingCard($uuid, $set, $card)
    {
        $row = Card::find($uuid);
        $row->name = $card["name"];
        $row->image_url = isset($card["multiverseid"]) ? "http://gatherer.wizards.com/Handlers/Image.ashx?multiverseid=".$card["multiverseid"]."&type=card" : null;
        $row->card_url = isset($card["multiverseid"]) ? "http://gatherer.wizards.com/Pages/Card/Details.aspx?multiverseid=".$card["multiverseid"] : null;
        $row->text = isset($card["text"]) ? $card["text"] : null;
        $row->flavor = isset($card["flavor"]) ? $card["flavor"] : null;
        $row->reserved = isset($card["reserved"]);
        $row->artist = $card["artist"];
        $row->rarity_id = $this->rarityImport($card["rarity"]);
        $row->mana_cost = isset($card["manaCost"]) ? $card["manaCost"] : null;
        $row->cmc = isset($card["cmc"]) ? $card["cmc"] : null;
        $row->power = isset($card["power"]) ? $card["power"] : null;
        $row->toughness = isset($card["toughness"]) ? $card["toughness"] : null;
        $row->multiverse_id = isset($card["multiverseid"]) ? $card["multiverseid"] : null;
        $row->import_id = $card["id"];
        $row->timeshifted = isset($card["timeshifted"]);
        $row->release_date = isset($set["releaseDate"]) ? Carbon::parse($set["releaseDate"]) : null;
        $row->json = json_encode($card);

        if(! filter_var($row->power, FILTER_VALIDATE_INT)){
            $row->power = -1;
            $row->exceptional_power = isset($card["power"]) ? $card["power"] : null;
        }

        if(! filter_var($row->toughness, FILTER_VALIDATE_INT)){
            $row->toughness = -1;
            $row->exceptional_toughness = isset($card["toughness"]) ? $card["toughness"] : null;
        }

        $row->save();
        return $row->id;
    }


    public function setImporter()
    {
        /*
         * This probably doesn't need anything else doing unless you are feeling brave and want to try linking it into blocks.
         */
        $this->info('<---------- Doing Set Imports ---------->');
        foreach($this->json as $set){
            $row = Set::where('name','=',$set["name"])->first();
            if(count($row) === 0){
                $this->info('----- Imported new set '.$set["name"].' to DB -----');
                $row = new Set();
                $row->name = $set["name"];
                $row->code = $set["code"];
                $row->release_date = Carbon::parse($set["releaseDate"]);
                $row->save();
            }else{
                $this->info('----- Updated set '.$set["name"].' in DB -----');
                $row->name = $set["name"];
                $row->code = $set["code"];
                $row->release_date = Carbon::parse($set["releaseDate"]);
                $row->save();
            }
        }
        $this->info('<---------- Finished Set Imports ---------->');
    }
}
