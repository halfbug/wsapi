<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Auth;
use App\File;
use Carbon\Carbon;

class FileController extends Controller
{
    //
	public function index($status = null)
	{
		$conditions = array(['parent_id', null]);
		
		if(!is_null($status))
		{
			$file = new file();
			$value = array_search(str_replace('-',' ',$status), $file->getAllStatus());
			array_push($conditions, ['status', $value]);
		}
		
		$files = File::where($conditions)->get();
		return view('files.index', compact('files'));
	}
	
	public function create() {
		return view('files.create');
	}
	
	public function store(Request $request) {
		
		if ($request->hasFile('photo')) {
			$user_id = Auth::id();
			foreach ($request->photo as $file) {
				$fileModel = new file;
				$fileModel->name = $file->getClientOriginalName();
				$fileModel->user_id = $user_id;
				$fileModel->ipaddress = $request->ip();
				$fileModel->status = 1;
				$fileModel->path = $file->store('public/upload/'.$user_id);
				$fileModel->save();
			}
		}
		
		return redirect()->route('fileList');
		
	}

	public function show($fileid) 
	{
		$file = File::find($fileid);
		return view('files.show')->with('file', $file);
	}
	
	public function destroy($id) {
		
	}

	public function format() {
		return view('files.format');
	}
	
	public function meta()
    {
        return view('meta.create');
    }
	
	public function startprocessing($fileid)
    {
    	$file = File::find($fileid);
    	$file->status = 2;
    	$file->save();
        return view('files.startprocessing')->with('file',$file);
    }

	public function startdownloading($fileid)
    {
    	$processedfile = File::where('parent_id', $fileid)->first();
    	$processedfile->status = 4;
    	$processedfile->save();
    	$file = File::find($fileid);
    	$file->status = 4;
    	$file->save();
        return view('files.startprocessing')->with('file',$processedfile);
    }

    public function downloadfile($fileid)
    {
    	$file = File::find($fileid);
    	$path = str_replace('/', '\\', storage_path('app\\'.$file->path));
    	return response()->download($path, $file->name);
    }

    public function search(Request $request)
    {
    	$conditions = array(['parent_id', null]);
    	if ($request->status) {
    		array_push($conditions, ['status','=',$request->status]);
    	}

    	if ($request->uploadtime) {
    		if ($request->uploadtime == 1) {
    			array_push($conditions, ['created_at', '>=', Carbon::today()->toDateString()]);
    		} elseif ($request->uploadtime == 2) {
    			array_push($conditions, ['created_at', '>=', Carbon::now()->subWeek()->startOfWeek()]);
    			array_push($conditions, ['created_at', '<=', Carbon::now()->subWeek()->endOfWeek()]);
    		} elseif ($request->uploadtime == 3) {
    			array_push($conditions, ['created_at', '>=', Carbon::now()->subMonth()->startOfMonth()]);
    			array_push($conditions, ['created_at', '<', Carbon::now()->startOfMonth()]);
    		}
    	}

    	$files = File::where($conditions)->get();
    	
    	if($request->user) {
    	  //if ($request->user == 3) {
		    foreach ($files as $key => $file) {
		    	$user = $file->user()->get();
		    	if (!$user[0]->hasRole('siteuser')) 
		    		unset($files[$key]);
		    }
    	  //}
	    }

	    return back()->with('files',$files);
    }

    public function uploadprocessed($fileid, Request $request)
    {
    	if ($request->hasFile('file')) {
			$user_id = Auth::id();
			$file = $request->file;
			
			$fileModel = new file;
			$fileModel->name = $file->getClientOriginalName();
			$fileModel->user_id = $user_id;
			$fileModel->ipaddress = $request->ip();
			$fileModel->status = 3;
			$fileModel->parent_id = $fileid;
			$fileModel->path = $file->store('public/processed/'.$user_id);
			$fileModel->save();
			
			$uploadedfile = File::find($fileid);
			$uploadedfile->status = 3;
			$uploadedfile->save();
		}
		
		return redirect()->route('fileList');
    }

}
