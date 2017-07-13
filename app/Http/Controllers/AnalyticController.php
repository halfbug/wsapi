<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\File;

class AnalyticController extends Controller
{
        public function index()
    {
		return view('analytics.index');

	}
        public function totalfiles()
    {
    $enabledpackages = File::all()->where('status', '=', 1);

	return view('analytics.totalfiles');

	}

}
