<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Auth;
use App\File;

class FileController extends Controller
{
    //
public function index(){
		$files = File::with('user')->get();
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
	public function show($fileid) {
		//$file=File::find($fileid);
		//return view(fileshowfile, $file =>$file );
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

    /**
    *   Filters Files list w.r.t user role
    *   @param  string $role
    */
    public function filtergrid($role)
    {
        return back()->with('role', $role);
    }

    /**
    *   Filters Files list w.r.t user role
    *   @param  string $role
    */
    public function search(Request $request, $role)
    {
    	$file = File::where("name", "LIKE","%".$request->search."%")->with('user')->get();
    	return back()->with(['role'=> $role, 'searchfile'=>$file]);
    }
}
