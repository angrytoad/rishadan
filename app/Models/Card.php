<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Webpatser\Uuid\Uuid;

class Card extends Model
{
    use Notifiable;
    use \App\Traits\Uuids;

    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'image_url',
        'card_url',
        'text',
        'flavour',
        'reserved',
        'artist',
        'rarity_id',
        'mana_cost',
        'cmc',
        'power',
        'toughness',
        'multiverse_id',
        'import_id',
        'timeshifted',
        'release_date',
        'twin_id',
        'json',
        'created_at',
        'updated_at',
    ];

    public function colors()
    {
        return $this->belongsToMany('App\Models\Color');
    }

    public function sets()
    {
        return $this->belongsToMany('App\Models\Set');
    }

    public function Subtypes()
    {
        return $this->belongsToMany('App\Models\Subtype');
    }

    public function Supertypes()
    {
        return $this->belongsToMany('App\Models\Supertype');
    }

    public function Types()
    {
        return $this->belongsToMany('App\Models\Type');
    }


}
