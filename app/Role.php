<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'desc'
    ];
    
    public static function sadmin(){
        $role=self::where('name', 'sadmin')->first();
        return $role->id ;
    }
    
    public static function admin(){
        $role = self::where('name', 'admin')->first();
        return  $role->id;
    }
    
     public static function siteuser(){
        $role = self::where('name', 'siteuser')->first();
        return  $role->id;
    }
    
    /**
     * The roles that belong to the user.
     */
    public function users() {
        return $this->belongsToMany('App\User', 'role_user');
    }
    
    /**
     * The permissions that belong to the role.
     */
    public function permissions() {
        return $this->belongsToMany('App\Permission', 'permission_role');
    }
    
}
