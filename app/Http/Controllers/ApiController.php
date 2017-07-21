<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class ApiController extends Controller
{

    public function index()
    {

        return view('frontend.api-index');
    }

    public function clients()
    {
        $users = User::all();
        return view('api.index')->with(compact('users'));
    }

    public function getAllClients()
    {



    }

} 
