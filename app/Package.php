<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'name', 'description', 'start_date', 'end_date','files_count','reset_count','price', 'status','created_at','duration'
    ];
    protected $statusz = [
        0 => 'Disabled',
        1 => 'Enabled',
		];
    protected $typez = [
        1 => 'Monthly',
        3 => 'One Time',
		];
    protected $duration_lang = [
        "months" => 'Monthly',
        "days" => 'days',
        "years" => 'Yearly',
        "Unlimited" => "Life time"
    ];
    public function getDuration() {
        return $this->duration_lang[$this->duration];
    }
    public function getAllStatus() {
        return $this->statusz;
    }
    public function getStatus() {
        return $this->statusz[$this->status];
    }
	
    public function getAllType() {
        return $this->typez;
    }
    public function getType() {
        return $this->typez[$this->type];
    }
    public function gettimeformat() {
        return date("d-M-Y h:i:s",strtotime($this->start_date));
    }


//    public function user() {
//        return $this->belongsTo('App\User');
//    }
  	public function discount()
	{
		return $this->belongsTo('App\Discount');
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
