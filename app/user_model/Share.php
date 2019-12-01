<?php

namespace App\user_model;

use Illuminate\Database\Eloquent\Model;
use App\user_model\Post;
class Share extends Model{
    
      public function posts()
     {
       return $this->belongsTo(Post::class);
     }
       public function client_users()
     {
       return $this->belongsTo(Client_user::class, 'user_id', 'email');
      // return $this->hasOne(Client_user::class, 'email');

     }
        
     public function comments(){
       return $this->hasMany(Comment::class);
     }

       public function likes()
     {
       return $this->hasMany(Like::class);
     }

}
