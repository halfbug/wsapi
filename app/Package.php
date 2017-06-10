<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    	public function discount()
	{
		return $this->belongsTo('App\Discount');
	}

}
