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
			//$uploadedFiles = $request->file('photo');
			foreach ($request->photo as $file) {
				$filePath = 'public/upload/'.$file->getClientOriginalName();
				$file->storeAs('public/upload',$file->getClientOriginalName());
				$fileModel = new file;
				$fileModel->user_id = Auth::id();
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
}
