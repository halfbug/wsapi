<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The roles which have the permission.
     */
    public function roles() {
        return $this->belongsToMany('App\Role', 'permission_role');
    }
    
}
