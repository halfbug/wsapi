<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
        if(\Auth::user()->hasRole('siteuser'))
            return view('frontend.home');
        else
        return view('home');
    }

    public function users()
    {
        $users = User::with('filesCount')->get()->toArray();
        return view('userlist', compact('users'));
    }
}
