<?php

namespace App\user_model;
use Illuminate\Database\Eloquent\Model;
use App\user_model\Like;
use App\user_model\Client_user;
use App\user_model\Share;
class Post extends Model
{

protected $fillable = [
'id','title','body','image','user_id','shared',
];	
   


   public function client_users()
     {
       return $this->belongsTo(Client_user::class, 'user_id', 'email');

     }
        
     public function comments(){
       return $this->hasMany(Comment::class);
     }

       public function likes()
     {
       return $this->hasMany(Like::class);
     }
    public function shares()
     {
       return $this->hasMany(Share::class);
     }
}
