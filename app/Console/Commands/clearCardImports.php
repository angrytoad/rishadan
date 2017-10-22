<?php

namespace App\Console\Commands;

use App\Models\Card;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class clearCardImports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clears out all set and card information from the table';

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
        if ($this->confirm(
            'Executing this command will remove all cards from the database, and break any existing 
            cards in the collections. This should only be used to test the card importer, Are you sure you want to continue?'
        )) {
            DB::table('sets')->delete();
            DB::table('cards')->delete();
            DB::table('colors')->delete();
            DB::table('rarities')->delete();

            DB::table('card_color')->delete();
            DB::table('card_set')->delete();
            DB::table('card_subtype')->delete();
            DB::table('card_supertype')->delete();
            DB::table('card_type')->delete();

            DB::table('subtypes')->delete();
            DB::table('supertypes')->delete();
            DB::table('types')->delete();

            $this->info('All cards cleared');
        }

    }
}
