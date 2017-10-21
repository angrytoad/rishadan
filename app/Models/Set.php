<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Webpatser\Uuid\Uuid;

class Set extends Authenticatable
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
        return $this->hasMany('App\Models\Card');
    }

    public function block()
    {
        return $this->belongsTo('App\Models\Block');
    }

}
