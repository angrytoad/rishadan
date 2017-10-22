<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Webpatser\Uuid\Uuid;

class CollectionCard extends Model
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
        'collection_id','card_id','user_id','image','condition','created_at','updated_at'
    ];

    public function addresses()
    {
        return $this->hasMany('App\Models\UserAddress');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function email_verification()
    {
        return $this->hasOne('App\Models\UserEmailVerification');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function collection()
    {
        return $this->hasOne('App\Models\Collection');
    }
    
    public function user()
    {
        return $this->hasOne('App\Models\User');
    }

    public function card()
    {
        return $this->hasOne('App\Models\Card');
    }
}
