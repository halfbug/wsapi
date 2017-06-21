<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilesPolicy
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

    public function before(User $user)
    {
        if ($user->hasRole('sadmin')) {
           return true;
        } 
    }

    public function startprocessing(User $user)
    {
        return $user->hasRole('admin');
    }

    public function searchfile(User $user)
    {
        return $user->hasRole('admin');
    }
}
