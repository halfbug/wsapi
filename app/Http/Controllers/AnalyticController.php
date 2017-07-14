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
    //$total = File::all()->where('status', '=', 1);
   // $total_files = File::all();
/* $fileListCount = $total_files->select([
    DB::raw('COUNT(DISTINCT id) as count'),
    DB::raw('DATE(`created_at`) as date')
])->groupBy('date')->get()->toArray();
 */	
$total_files = DB::table('files')
                     ->select(DB::raw('COUNT(*) as file_count, created_at'))
                     ->distinct()
					 ->groupBy('created_at')
                    ->get();
 //$total_files = DB::table('files')->groupBy('created_at')->get();
// return view('analytics.totalfiles',['total_files' => $total_files]);
 return view('analytics.totalfiles')->with(compact('total_files'));

	}

}
