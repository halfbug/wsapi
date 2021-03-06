<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Auth;
use App\File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\UserMeta;
use App\Notifications\FileProcessed;

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

        if(Auth::user()->hasRole('siteuser'))
            array_push($conditions, ['user_id', Auth::id()]);

		$files = File::where($conditions)->orderBy('id','desc')->get();
		return view('files.index', compact('files'));
	}
	
    public function countfilesforgivendate($date)
    {
		$filefordate=File::all()->where("created_at", $date);
		$totalfilefordate=count($filefordate);
		return $totalfilefordate;
	}

	public function create() {
		$admin_ids = $this->AllAdminIds();
		if (!Auth::guest()) {
			array_push($admin_ids, Auth::id());
		}
        $deletionPeriod = UserMeta::where('name', 'Deletion Period')->get();
		$meta = UserMeta::whereIn('user_id', $admin_ids)->get();
        foreach ($meta as $key => $value) {
            if ($value->name == 'Deletion Period') {
               unset($meta[$key]);
            } elseif ($value->user_id != Auth::id() && $value->fixed == 0) {
               unset($meta[$key]);
            } else {
                $separate_values = explode(',', $value->value);
                $separate_values = array_filter($separate_values, 'strlen');
                $check = array_filter($separate_values,'is_numeric');
                $value->is_numeric = ($separate_values == $check)? true: false;
                $value->separate_values = $separate_values;
            }
        }
        
		return view('files.create')->with(['meta'=> $meta, 'deletionPeriod' => $deletionPeriod]);
	}
	
	public function store(Request $request) {
		
		if ($request->hasFile('photos')) {
			$user_id = (Auth::user())?Auth::user()->id:null;
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
                     ///////Todo check for free user quota
					$tot = \App\File::whereNull("user_id")->with("user")->where("ipaddress",$ip)->count();

					if($tot>10) {
						return response()->json(array("error"=>"Your free quota is expired"),501);
	
						}//endif
                    } else{
                        $subsctioption=\Auth::user()->subscription()->active()->first();
                        // no package subscribed by registered user
                        if ($subsctioption == null) {
                            $fileModel->path = $photo->store('public/upload/' . $user_id);
                        } else {
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
		$file = File::where('id',$fileid)->first();
        $meta = $file->metadata()->get();
		return view('files.show')->with(['file'=> $file, 'meta' => $meta]);
	}
	
	public function destroy($id) {
        $file=File::find($id);
		Storage::delete($file->path);
        $file->delete();
                
        return response()->json(array($file->path => true), 200);
	}

    public function delete($id)
    {
        $this->destroy($id);
        return back();
    }

	public function format() {
		return view('files.format');
	}
	
	public function meta()
    {
        $deletionPeriod = UserMeta::where('name','Deletion Period')->get();
    	$usermeta = UserMeta::where([['user_id',Auth::id()],['fixed',0]])->orderBy('id','asc')->get();
    	$adminmeta = UserMeta::where('fixed',1)->orderBy('id','asc')->get();
    	foreach ($adminmeta as $value) {
    		$separate_values = explode(',', $value->value);
		   	$check = array_filter($separate_values,'is_numeric');
		   	$value->is_numeric = ($separate_values == $check)? true: false;
		}
		foreach ($usermeta as $key => $value) {
    		$separate_values = explode(',', $value->value);
		   	$check = array_filter($separate_values,'is_numeric');
		   	$value->is_numeric = ($separate_values == $check)? true: false;
            if ($value->name == 'Deletion Period') {
                unset($usermeta[$key]);
            }
		}

        return view('meta.create', compact('usermeta','adminmeta','deletionPeriod'));
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
    	$path = str_replace('\\', '/', storage_path('app/'.$file->path));
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
              if ($file->user_id) {
		    	$user = $file->user()->first();
		    	if (!$user->hasRole('siteuser')) 
		    		unset($files[$key]);
              } else {
                    unset($files[$key]);
              }
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

            if ($uploadedfile->user_id)
                $uploadedfile->user->notify(new FileProcessed($uploadedfile));
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
            if (in_array($user_id, $admin_ids)){
                UserMeta::updateOrCreate(['name'=>'Deletion Period'],['value'=>$request->deletion_period, 'user_id'=>$user_id]);
                $prev_meta = UserMeta::whereIn('user_id', $admin_ids)->where([['name','!=','Deletion Period']])->delete();
            } else
    		    $prev_meta = UserMeta::where('user_id', $user_id)->delete();
            foreach ($meta as $value) {
                $value->save();
            }
    		$err['success'] = "Meta Data has been saved successfully";
    		return redirect()->back()->withErrors($err);
    	}
    	else{
            $err['show_old'] = true;
  		  	return redirect()->back()->withErrors($err)->withInput();
        }
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
            $filemeta_model = new \App\FileMeta();
            $filemeta_model->name = 'Deletion Period';
            $filemeta_model->value = $request->deletion_period;
            $filemeta_model->file_id = $file->id;
            $filemeta_model->save();
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
