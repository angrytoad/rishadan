<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Webpatser\Uuid\Uuid;

class Set extends Model
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
        'code',
        'release_date',
        'block_id',
        'created_at',
        'updated_at',
    ];


    public function cards()
    {
        return $this->belongsToMany('App\Models\Card');
    }

    public function block()
    {
        return $this->belongsTo('App\Models\Block');
    }

}
