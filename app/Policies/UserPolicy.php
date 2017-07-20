<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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

    public function performAdmin(User $user)
    {

        return (\Auth::user()->hasRole('admin') ||\Auth::user()->hasRole('sadmin')) ;
    }

    public function performSiteuser(User $user)
    {
//            var_dump(\Auth::user()->hasRole('siteuser'));
        return \Auth::user()->hasRole('siteuser');
    }
}
