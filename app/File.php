<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
	/**
	*	Gets the user of the file
	*/
	public function user()
	{
		return $this->belongsTo('App\User');
	}
}
