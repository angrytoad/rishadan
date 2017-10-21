<?php

namespace App\Console\Commands;

use App\Models\Set;
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

        /*
         * Uncomment/Comment these are you need them these as you need them
         */
        $this->setImporter();
    }

    public function setImporter()
    {
        $this->info('---------- Doing Set Imports ----------');
        foreach($this->json as $set){
            $row = Set::where('name','=',$set["name"])->first();
            if($row === null){
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
        $this->info('---------- Finished Set Imports ----------');
    }
}
