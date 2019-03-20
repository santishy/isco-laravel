<?php

namespace App\Policies;

use App\User;
use App\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function authorize()
    {
        return true;
    }
    public function admin(User $user,Role $role)
    {
    
      if($user->isAdmin()){
        return true;
      }
      return false;
    }
    public function before(User $user){

      if($user->isAdmin()){
        return true;
      }
      return false;
    }
}
