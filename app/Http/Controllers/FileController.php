<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Auth;
use App\File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\UserMeta;


class FileController extends Controller
{
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
		$admin_ids = $this->AllAdminIds();
		if (!Auth::guest()) {
			array_push($admin_ids, Auth::id());
		}
		$meta = UserMeta::whereIn('user_id', $admin_ids)->get();
        foreach ($meta as $value) {
            $separate_values = explode(',', $value->value);
            $check = array_filter($separate_values,'is_numeric');
            $value->is_numeric = ($separate_values == $check)? true: false;
            $value->separate_values = $separate_values;
        }
		return view('files.create')->with('meta', $meta);
	}
	
	public function store(Request $request) {
		
		if ($request->hasFile('photos')) {
			$user_id = Auth::user()->id;
            $photos = [];
			foreach ($request->photos as $photo) {
				if (strpos($request->ip(), ':')) {
					$ip = strstr($request->ip(),':',true);
				}
				else 
					$ip = $request->ip();
				if(\App\File::where("name",$photo->getClientOriginalName())->where("ipaddress",$ip)->count()<1)
				{
                    $fileModel = new file;
                    $fileModel->name = $photo->getClientOriginalName();
                    $fileModel->user_id = $user_id;
                    $fileModel->ipaddress = $ip;
                    $fileModel->status = 1;
                    if (Auth::guest()) {
                        $fileModel->path = $photo->store('public/upload/' . $ip);
                        //Todo check for free user quota
                    } else{
                        $subsctioption=\Auth::user()->subscription()->active()->first();
//                        dd($subsctioption);
//                        dd($subsctioption->files_upload_balance );
                        if($subsctioption->files_upload_balance > 0) {
//                             dd($subsctioption);
                            $fileModel->path = $photo->store('public/upload/' . $user_id);
                            $subsctioption->files_upload_balance = $subsctioption->setUploadBalance();
                            $subsctioption->save();
                        }
                        else
                            return response()->json(array("error"=>"Package Expire"),501);
                    }

                    $fileModel->save();

                    $photo_object = new \stdClass();
                    $photo_object->name = str_replace('photos/', '', $photo->getClientOriginalName());
                    $photo_object->size = round(\Storage::size($fileModel->path) / 1024, 2);
                    $photo_object->fileID = $fileModel->id;
                    $photo_object->url = url("../storage/app/" . $fileModel->path);
                    $photo_object->deleteType = "DELETE";
                    $photo_object->deleteUrl = url('file/destroy/' . $fileModel->id);
                    $photos[] = $photo_object;
                }
                else{
				    return response()->json("file already exist.",406);
                }
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
    	$usermeta = UserMeta::where([['user_id',Auth::id()],['fixed',0]])->get();
    	$adminmeta = UserMeta::where('fixed',1)->get();
    	foreach ($adminmeta as $value) {
    		$separate_values = explode(',', $value->value);
		   	$check = array_filter($separate_values,'is_numeric');
		   	$value->is_numeric = ($separate_values == $check)? true: false;
		}
		foreach ($usermeta as $value) {
    		$separate_values = explode(',', $value->value);
		   	$check = array_filter($separate_values,'is_numeric');
		   	$value->is_numeric = ($separate_values == $check)? true: false;
		}
        return view('meta.create', compact('usermeta','adminmeta'));
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

    public function storemeta(Request $request)
    {
    	$user_id = Auth::id();
    	$values[] = $request->values;
    	$err = array();
    	$meta = array();
    	$no_name = 0;
    	foreach ($request->name as $key => $name) {
	    	if (!is_null($name)) {
	    		//$field_number = $key + 2;
	    		if (empty($values[0][$key])) {
	    			$err['field'.$key] = "Value field cannot be empty";
	    		} else {
		   			$separate_values = explode(',', $values[0][$key]);
		   			$check = array_filter($separate_values,'is_numeric');
		   			if ($key < 11 && !empty($check)) {
		   				$err['field'.$key] = "All values must be text";
		   			}elseif ($key >= 11 && $check !== $separate_values) {
		   				$err['field'.$key] = "All values must be numeric";
		   			}
		   			if (empty($err)) {
		   				$meta_model = new UserMeta;
		   				if ($request->has('fixed') && array_key_exists($key, $request->fixed)) 
		   					$meta_model->fixed = ($request->fixed[$key] == "on")? 1: 0;
			    		$meta_model->user_id = $user_id;
			    		$meta_model->name = $name;
			    		$meta_model->value = $values[0][$key];
			    		array_push($meta, $meta_model);
		   			}
	    		}
	    	} else {
	    		$no_name++;
	    	}
	    }
	    
   		if ($no_name == 14)
   			$err['failure'] = "Atlease ONE meta field must be provided";
   		
    	// if no error, then save new meta and delete previous meta of the user
    	if (empty($err)) {
            $admin_ids = $this->AllAdminIds();
            if (in_array($user_id, $admin_ids))
                $prev_meta = UserMeta::whereIn('user_id', $admin_ids)->delete();
            else
    		    $prev_meta = UserMeta::where('user_id', $user_id)->delete();
            foreach ($meta as $value) {
                $value->save();
            }
    		$err['success'] = "Meta Data has been saved successfully";
    		return redirect()->back()->withErrors($err);
    	}
    	else
  		  	return redirect()->back()->withErrors($err)->withInput();
    }

	/**
	*	Return array of ids of super admin and all other admins
	*/
    public function AllAdminIds()
    {
    	$admin_ids = \App\User::whereHas('roles' ,function($q){
				    		$q->whereIn('name', ['admin','sadmin']);
						})->pluck('id')->toArray();
    	return $admin_ids;
    }

    public function storeFileMeta(Request $request)
    {
       if (Auth::guest()) {
            $files = File::where(['ipaddress',$request->ip()])->doesntHave('metadata')->get();
        } else {
            $files = File::where([['ipaddress',$request->ip()],['user_id',Auth::id()]])->doesntHave('metadata')->get();
        }

        foreach ($files as $file) {
            foreach ($request->filemeta as $name => $value) {
                $filemeta_model = new \App\FileMeta();
                $filemeta_model->name = $name;
                $filemeta_model->value = $value;
                $filemeta_model->file_id = $file->id;
                $filemeta_model->save();
            }
        }

        return redirect()->back();
    }
}
