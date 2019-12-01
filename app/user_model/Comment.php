<?php

namespace App\user_model;
use Post;
use Client_user;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
protected $fillable = [
'id','post_id','user_id','comment',
];	

      public function posts()
     {
       return $this->belongsTo(Post::class);
     }

function client_users(){

    return $this->belongsTo(Client_user::class);
}

}
