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
		$files=File::all();
		return view('files.index', compact('files'));
	
	}
	
	public function create() {
		return view('files.create');
	}
	
	public function store(Request $request) {
		
		if ($request->hasFile('photo')) {
			$user_id = Auth::id();
			foreach ($request->photo as $file) {
				$filePath = 'public/upload/'.$user_id.'/'.$file->getClientOriginalName();
				$file->storeAs('public/upload/'.$user_id, $file->getClientOriginalName());
				$fileModel = new file;
				$fileModel->user_id = $user_id;
				$fileModel->ipaddress = $request->ip();
				$fileModel->path = $filePath;
				$fileModel->status = 1;
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
}
