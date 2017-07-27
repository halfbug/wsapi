<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\User;
use App\File;
use Carbon\Carbon;

class AnalyticController extends Controller
{
    public function index()
    {
        return view('analytics.index');

    }
protected $dateRec;
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
//	$totalfiles = DB::table('files')
//            ->join('role_user', 'files.user_id', '=', 'role_user.user_id')
//            ->where('role_user.role_id', '=', 3)
//            ->select('files.*')
//            ->distinct('created_at')->get();

//            $lastWeekStart = Carbon::today()->subWeek();


        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();

        $files = \App\File::whereBetween("created_at",[$startDate,$endDate])->with("user")->with("user.roles")->get();


//Init interval
        $dateInterval = \DateInterval::createFromDateString('1 day');
//Init Date Period from start date to end date
//1 day is added to end date since date period ends before end date. See first comment: http://php.net/manual/en/class.dateperiod.php
        $datePeriod = new \DatePeriod($startDate, $dateInterval, $endDate->modify('+1 day'));

       $data = [];
        foreach($datePeriod as $datePeriodRow){
//            var_dump($datePeriodRow->toDateString());
            $this->dateRec =$datePeriodRow;
            $data[]=[
                "y"=> $datePeriodRow->format('d-M-y'),
//                "a"=> $files->where("created_at",$datePeriodRow)->whereNull("parent_id")->count(),
                "a"=> $files->filter(function ($record, $key) {
                   return  $this->dateRec->isSameDay(Carbon::parse($record->created_at)) &&
                       is_null($record->parent_id);
                    })->count(),
//                 "b"=> $files->where("created_at",$datePeriodRow)->whereNotNull("parent_id")->count() ];
                 "b"=> $files->filter(function ($record, $key) {
                     return  $this->dateRec->isSameDay(Carbon::parse($record->created_at)) &&
                         !is_null($record->parent_id);
                 })->count()
            ];
        }

//        dd($data);
	 return view('analytics.totalfiles')->with(compact('data'));

    }//function end
    public function averagetime()
    {
        $files = DB::table('files')
            ->select(DB::raw('DATE(created_at) AS dt,AVG(DATEDIFF(updated_at,created_at)) average'))
            ->where('created_at', '<>', 'updated_at')
            ->groupBy(DB::raw('DATE(created_at)'))
            //->orderBy('updated_at')
            ->get();

        $data = [];
        foreach($files as $file)
        {
            $data[]=[
                "y"=> date('d-m-Y',strtotime($file->dt)),
                "a"=> number_format($file->average,2)
            ];
        }

//        dd($data);
        return view('analytics.averagetime')->with(compact('data'));

    }//function end
    public function last31upload()
    {
        /* getting all users which are siteusers i.e. role_id=3*/
        /* 		$users = DB::table('users')
                    ->join('role_user', 'users.id', '=', 'role_user.user_id')
                    ->where('role_user.role_id', '=', 3)
                    ->select('users.*')
                    ->get();

         */
        /* total files uploaded by site user*/
//	$totalfiles = DB::table('files')
//            ->join('role_user', 'files.user_id', '=', 'role_user.user_id')
//            ->where('role_user.role_id', '=', 3)
//            ->select('files.*')
//            ->distinct('created_at')->get();

//            $lastWeekStart = Carbon::today()->subWeek();


        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();

        $files = \App\File::whereBetween("created_at",[$startDate,$endDate])->with("user")->with("user.roles")->get();


//Init interval
        $dateInterval = \DateInterval::createFromDateString('1 day');
//Init Date Period from start date to end date
//1 day is added to end date since date period ends before end date. See first comment: http://php.net/manual/en/class.dateperiod.php
        $datePeriod = new \DatePeriod($startDate, $dateInterval, $endDate->modify('+1 day'));

        $data = [];
        foreach($datePeriod as $datePeriodRow){
//            var_dump($datePeriodRow->toDateString());
            $this->dateRec =$datePeriodRow;
            $data[]=[
                "y"=> $datePeriodRow->format('d-M-y'),
//                "a"=> $files->where("created_at",$datePeriodRow)->whereNull("parent_id")->count(),
                "a"=> $files->filter(function ($record, $key) {
                    return  $this->dateRec->isSameDay(Carbon::parse($record->created_at)) &&
                        is_null($record->parent_id);
                })->count(),
//                 "b"=> $files->where("created_at",$datePeriodRow)->whereNotNull("parent_id")->count() ];
                "b"=> $files->filter(function ($record, $key) {
                    return  $this->dateRec->isSameDay(Carbon::parse($record->created_at)) &&
                        !is_null($record->parent_id);
                })->count()
            ];
        }

//        dd($data);
        return view('analytics.last31upload')->with(compact('data'));

    }//function end
    public function uploadfile()
    {
        /* getting all users which are siteusers i.e. role_id=3*/
        /* 		$users = DB::table('users')
                    ->join('role_user', 'users.id', '=', 'role_user.user_id')
                    ->where('role_user.role_id', '=', 3)
                    ->select('users.*')
                    ->get();

         */
        /* total files uploaded by site user*/
//	$totalfiles = DB::table('files')
//            ->join('role_user', 'files.user_id', '=', 'role_user.user_id')
//            ->where('role_user.role_id', '=', 3)
//            ->select('files.*')
//            ->distinct('created_at')->get();

//            $lastWeekStart = Carbon::today()->subWeek();


        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();

        $files = \App\File::whereBetween("created_at",[$startDate,$endDate])->with("user")->with("user.roles")->get();


//Init interval
        $dateInterval = \DateInterval::createFromDateString('1 day');
//Init Date Period from start date to end date
//1 day is added to end date since date period ends before end date. See first comment: http://php.net/manual/en/class.dateperiod.php
        $datePeriod = new \DatePeriod($startDate, $dateInterval, $endDate->modify('+1 day'));

        $data = [];
        foreach($datePeriod as $datePeriodRow){
//            var_dump($datePeriodRow->toDateString());
            $this->dateRec =$datePeriodRow;
            $data[]=[
                "y"=> $datePeriodRow->format('d-M-y'),
//                "a"=> $files->where("created_at",$datePeriodRow)->whereNull("parent_id")->count(),
                "a"=> $files->filter(function ($record, $key) {
                    return  $this->dateRec->isSameDay(Carbon::parse($record->created_at)) &&
                        is_null($record->parent_id);
                })->count(),
//                 "b"=> $files->where("created_at",$datePeriodRow)->whereNotNull("parent_id")->count() ];
                "b"=> $files->filter(function ($record, $key) {
                    return  $this->dateRec->isSameDay(Carbon::parse($record->created_at)) &&
                        !is_null($record->parent_id);
                })->count()
            ];
        }

//        dd($data);
        return view('analytics.uploadfile')->with(compact('data'));

    }//function end

}
