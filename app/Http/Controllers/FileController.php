<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Auth;
use App\File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


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
		
		if ($request->hasFile('photos')) {
			$user_id = Auth::id();
            $photos = [];
			foreach ($request->photos as $photo) {
				$fileModel = new file;
//                                var_dump($file);
				$fileModel->name = $photo->getClientOriginalName();
				$fileModel->user_id = $user_id;
				$fileModel->ipaddress = $request->ip();
				$fileModel->status = 1;
				if (Auth::guest()) {
					$ip = strstr($request->ip(),':',true);
					$fileModel->path = $photo->store('public/upload/'.$ip);
				} else
					$fileModel->path = $photo->store('public/upload/'.$user_id);
				$fileModel->save();
                                
                $photo_object = new \stdClass();
        		$photo_object->name = str_replace('photos/', '',$photo->getClientOriginalName());
		        $photo_object->size = round(\Storage::size($fileModel->path) / 1024, 2);
		        $photo_object->fileID = $fileModel->id;
		        $photo_object->url = url("../storage/app/".$fileModel->path);
		        $photo_object->deleteType = "DELETE";
		        $photo_object->deleteUrl = url('file/destroy/'.$fileModel->id);
		        $photos[] = $photo_object;
			}
		}
		
//		return redirect()->route('fileList');
                return response()->json(array('files' => $photos), 200);
		
	}

	public function show($fileid) 
	{
		$file = File::find($fileid);
		return view('files.show')->with('file', $file);
	}
	
	public function destroy($id) {
            $file=File::find($id);
		Storage::delete($file->path);
                $file->delete();
                
                 return response()->json(array($file->path => true), 200);
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
        return view('files.downloadfile')->with('file',$processedfile);
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
