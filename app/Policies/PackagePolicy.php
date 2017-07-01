<?php

namespace App\Policies;

use App\User;
use App\Package;
use Illuminate\Auth\Access\HandlesAuthorization;

class PackagePolicy
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
    
    public function performAdmin(User $user, Package $package)
    {
        
        return (\Auth::user()->hasRole('admin') ||\Auth::user()->hasRole('sadmin')) ;
    }
    
        public function performSiteuser(User $user, Package $package)
    {
//            var_dump(\Auth::user()->hasRole('siteuser'));
            return \Auth::user()->hasRole('siteuser');
    }
}
