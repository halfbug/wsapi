<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnalyticController extends Controller
{
        public function index()
    {
		return view('analytics.index');

	}
        public function totalfiles()
    {
		return view('analytics.totalfiles');

	}

}
