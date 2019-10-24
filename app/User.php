<?php
namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
  use HasApiTokens, Notifiable;


protected $fillable = [
'firstName','lastName','phone','gender','status','role','email','password',
];
protected $hidden = [
'password', 'remember_token',
];
}
