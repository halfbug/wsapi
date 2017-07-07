<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileMeta extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'meta_data';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'name', 'value', 'file_id', 
    ];

    /**
     * Get the file for the meta data.
     */
    public function file()
    {
        return $this->belongsTo('App\User');
    }
}
