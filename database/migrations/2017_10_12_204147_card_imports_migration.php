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
            $table->string('name');
            $table->string('image_url')->nullable();
            $table->string('card_url')->nullable();
            $table->text('text')->nullable();
            $table->text('flavor')->nullable();
            $table->boolean('reserved');
            $table->string('artist');
            $table->uuid('rarity_id')->nullable();
            $table->string('mana_cost')->nullable();
            $table->integer('cmc')->nullable();
            $table->integer('power')->nullable();
            $table->integer('toughness')->nullable();
            $table->string('multiverse_id')->nullable();
            $table->string('import_id')->index();
            $table->boolean('timeshifted');
            $table->dateTime('release_date')->nullable();
            $table->string('exceptional_power')->nullable();
            $table->string('exceptional_toughness')->nullable();
            $table->json('json');
            $table->timestamps();
        });

        Schema::create('variations', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('variation_id');
            $table->uuid('card_id');
            $table->timestamps();
        });

        Schema::create('colors', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('card_color', function (Blueprint $table) {
            $table->uuid('card_id');
            $table->uuid('color_id');
        });        

        Schema::create('rarities', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('supertypes', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('supertype');
            $table->timestamps();
        });

        Schema::create('card_supertype', function (Blueprint $table) {
            $table->uuid('card_id');
            $table->uuid('supertype_id');
        });

        Schema::create('types', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('type');
            $table->timestamps();
        });

        Schema::create('card_type', function (Blueprint $table) {
            $table->uuid('card_id');
            $table->uuid('type_id');
        });

        Schema::create('subtypes', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('subtype');
            $table->timestamps();
        });

        Schema::create('card_subtype', function (Blueprint $table) {
            $table->uuid('card_id');
            $table->uuid('subtype_id');
        });

        Schema::create('blocks', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('card_set', function (Blueprint $table) {
            $table->uuid('card_id');
            $table->uuid('set_id');
        });

        Schema::create('sets', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->string('code');
            $table->dateTime('release_date');
            $table->uuid('block_id')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('card_set');
        Schema::dropIfExists('variations');
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
