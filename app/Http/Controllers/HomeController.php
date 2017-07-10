<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Auth;
use App\User;
use App\File;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->created_at > Carbon::now()->subMinutes(5)->toDateTimeString()) { // newly registered users i.e. 5mins ago check
            $ip = (strpos(request()->ip(), ':'))? strstr(request()->ip(),':',true) : request()->ip();
            $files = File::where('user_id', null)->get();   // get files uploaded by all guests
            foreach ($files as $file) {
                if ($file->ipaddress == $ip) {      // if this registered user uploaded files as guest   
                    $file->user_id = Auth::id();    // then change those files user_id from 'null' to this user's id
                    $file->save();
                }
            }
        }

        if(Auth::user()->hasRole('siteuser'))
            return view('frontend.home');
        else
        return view('home');
    }

}
