<?php

namespace App\Models;

use App\Uuids;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use Uuids;

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 
        'first_line', 
        'second_line', 
        'city', 
        'postcode', 
        'country', 
        'created_at', 
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
