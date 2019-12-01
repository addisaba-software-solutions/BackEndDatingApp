<?php

namespace App\user_model;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    public function posts(){
    	
   return $this->hasMany(Post::class);
}
}
