<?php

namespace App;

use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable,ShinobiTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function roles(){
      return $this->belongsToMany('App\Role','role_user');
    }
    public function isAdmin(){
      return $this->roles()->where('name','=','admin')->first();
    }
    public static function isCheckAndAdmin(){
      if(Auth::check())
        if(Auth::user()->can('dashboard'))
          return true;
      return false;
    }
}
