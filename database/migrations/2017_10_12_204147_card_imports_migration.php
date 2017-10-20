<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CardImportsMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('json_id');
            $table->string('name');
            $table->uuid('set_id');
            $table->string('image_url');
            $table->string('card_url');
            $table->text('text');
            $table->text('flavor');
            $table->boolean('reserved');
            $table->string('artist');
            $table->uuid('rarity_id');
            $table->string('mana_cost');
            $table->integer('cmc');
            $table->integer('power');
            $table->integer('toughness');
            $table->string('multiverse_id');
            $table->boolean('timeshifted');
            $table->dateTime('release_date')->nullable();
            $table->uuid('twin_id')->nullable();
            $table->json('json');
        });

        Schema::create('variations', function (Blueprint $table) {

        });

        Schema::create('card_variation', function (Blueprint $table) {

        });  

        Schema::create('colors', function (Blueprint $table) {

        });

        Schema::create('card_color', function (Blueprint $table) {

        });        

        Schema::create('rarities', function (Blueprint $table) {

        });

        Schema::create('supertypes', function (Blueprint $table) {
            
        });

        Schema::create('card_supertype', function (Blueprint $table) {
            
        });

        Schema::create('types', function (Blueprint $table) {
            
        });

        Schema::create('card_type', function (Blueprint $table) {
            
        });

        Schema::create('subtypes', function (Blueprint $table) {
            
        });

        Schema::create('card_subtype', function (Blueprint $table) {
            
        });

        Schema::create('blocks', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
        });

        Schema::create('sets', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->string('code');
            $table->dateTime('release_date');
            $table->uuid('block_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
        Schema::dropIfExists('blocks');
        Schema::dropIfExists('sets');
        Schema::dropIfExists('variations');
        Schema::dropIfExists('card_variation');
        Schema::dropIfExists('colors');
        Schema::dropIfExists('card_color');
        Schema::dropIfExists('rarities');
        Schema::dropIfExists('supertypes');
        Schema::dropIfExists('card_supertype');
        Schema::dropIfExists('types');
        Schema::dropIfExists('card_type');
        Schema::dropIfExists('subtypes');
        Schema::dropIfExists('card_subtype');
    }
}
