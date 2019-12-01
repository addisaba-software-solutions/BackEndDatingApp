<?php

namespace App\user_model;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\user_model\Post;
use App\user_model\Comment;
use App\user_model\Like;
use App\user_model\ProfileLike;
use App\user_model\ProfileLove;
use App\user_model\ProfileSuperLove;
use App\user_model\ProfileVisited;
class Client_user extends Authenticatable
{
	  use HasApiTokens, Notifiable;
	
    protected $fillable = [
'firstName','lastName','phone','gender','status','role','email','password',
];
protected $hidden = [
'password', 'remember_token',
];

  public function posts()
    {
        return $this->hasMany(Post::class);
    }

 public function comments()
     {
       return $this->hasMany(Comment::class);
     }
     
  public function likes()
     {
       return $this->belongsTo(Like::class);
     }
     
      public function profileLikes(){
       return $this->hasMany(ProfileLike::class,'liked','email');
     }

     public function profileLoves(){
       return $this->hasMany(ProfileLove::class,'loved','email');
     }

     public function profileSuperLoves(){
       return $this->hasMany(ProfileSuperLove::class,'super_loved','email');
     }
     
     public function profileVisited(){
       return $this->hasMany(ProfileVisited::class,'visited','email');
     }
    
}

