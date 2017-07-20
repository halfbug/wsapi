<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

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
    // execute on every action
     public static function boot() {
        parent::boot();


        // create a event to happen on saving
        static::creating(function($table) {
            $table->ip = \Request::ip();
        });

        
    }
    
     /**
     * The roles that belong to the user.
     */
    public function roles() {
        return $this->belongsToMany('App\Role', 'role_user');
    }
    
    public function assignRole($role)
    {
        if(is_string($role))
        {
            return $this->roles()->save($role);

        }

        return $this->roles()->save(
            Role::whereName($role)->first()
        );
    }

    public function hasRole($role)
    {
        if(is_string($role))
        {
            return $this->roles->contains('name', $role);

        }
        return !! $role->intersect($this->roles)->count();
    }

    /**
    *   Gets the files of the user
    */
    public function files()
    {
        return $this->hasMany('App\File');
    }

    public function filesCount()
    {
        return $this->hasOne('App\File')
            ->selectRaw('user_id, count(*) as count')
            ->groupBy('user_id');
    }

    /*public function getFilesCountAttribute()
    {
        return $this->filesCount->count();
    }*/

    /**
     * Get the custom meta data saved by the user.
     */
    public function metadata()
    {
        return $this->hasMany('App\UserMeta');
    }

    /**
     * Get the associated subscription
     *
     * @var array
     */
    public function Subscription() {

        return $this->hasMany('App\Subscription');
    }

}
