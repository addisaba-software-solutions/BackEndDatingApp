<?php

namespace App\user_model;

use Illuminate\Database\Eloquent\Model;
use Client_user;
class ProfileLike extends Model
{
    protected $fillable = [
'id','liker','liked',
];	

 function client_users(){
       return $this->belongsTo(Client_user::class);
 
}
}