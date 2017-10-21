<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Webpatser\Uuid\Uuid;

class Block extends Authenticatable
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
        'created_at',
        'updated_at',
    ];


    public function sets()
    {
        return $this->hasMany('App\Models\Set');
    }

}
