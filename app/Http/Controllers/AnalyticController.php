<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
	/* getting all users which are siteusers i.e. role_id=3*/
/* 		$users = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->where('role_user.role_id', '=', 3)
            ->select('users.*')
            ->get();	
	
 */	
 /* total files uploaded by site user*/
	$totalfiles = DB::table('files')
            ->join('role_user', 'files.user_id', '=', 'role_user.user_id')
            ->where('role_user.role_id', '=', 3)
            ->select('files.*')
            ->distinct('created_at')->get();	
	        //$filemodel = \App\File::all();
	
	 return view('analytics.totalfiles')->with(compact('totalfiles'));

	}//function end

}
