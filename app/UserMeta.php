<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'meta_data_setting';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'name', 'value', 'user_id', 
    ];

    /**
     * Get the user who saved the custom meta data.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
