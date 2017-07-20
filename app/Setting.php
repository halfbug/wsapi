<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //
    protected $fillable = ['name','value','status','option','section'];

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

}
