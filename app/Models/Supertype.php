<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Webpatser\Uuid\Uuid;

class Supertype extends Model
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
        'supertype',
        'created_at',
        'updated_at',
    ];

    public function cards()
    {
        return $this->belongsToMany('App\Models\Card');
    }


}
