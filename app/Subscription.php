<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'user_id','subscription_id','customer_profile_id','ref_id',
        'first_name','last_name','address','city','state_id','zip_code','country_id',
        'card_expiry_date',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
