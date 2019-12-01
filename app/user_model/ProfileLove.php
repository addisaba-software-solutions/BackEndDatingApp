<?php

namespace App\user_model;

use Illuminate\Database\Eloquent\Model;
use Client_user;
class ProfileLove extends Model
{
       function client_users(){

    return $this->belongsTo(Client_user::class);
}
}
