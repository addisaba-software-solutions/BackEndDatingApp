<?php

namespace App\user_model;

use Illuminate\Database\Eloquent\Model;
use Post;
use Client_user;

 class Like extends Model
{

protected $fillable = [
'id','user_id','post_id','is_liked',
];	
   public function posts()
     {
       return $this->belongsTo(Post::class);
     }

function client_users(){

    return $this->belongsTo(Client_user::class);
}
}
