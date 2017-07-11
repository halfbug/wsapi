<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    public $fillable = ['user_id', 'package_id', 'start_date', 'end_date', 'files_upload_balance','status'];

    /**
     * Get the package that owns the subscription.
     */
    public function package()
    {
        return $this->belongsTo('App\Package');
    }

    /**
     * Get the user that owns the subscription.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function scopeActive($query) {


            return $query->where('user_id', '=', \Auth::user()->id)->where('status',1);

    }
}
