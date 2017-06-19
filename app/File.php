<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user_id', 'ipaddress', 'path', 'status','created_at'
    ];
    protected $statusz = [
        0 => 'Not Defined',
        1 => 'Uploaded',
        2 => 'In Progress',
        3 => 'Processed',
        4 => 'Downloaded',
    ];

    public function getAllStatus() {
        return $this->statusz;
    }

    public function getStatus() {
        return $this->statusz[$this->status];
    }

    /**
     * 	Gets the user of the file
     */
    public function user() {
        return $this->belongsTo('App\User');
    }
    
    public function getCreated_AtAttribute() {
        return date("d-M-Y h:i:s",strtotime($this->created_at));
    }
}
