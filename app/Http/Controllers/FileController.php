<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\File;

class FileController extends Controller
{
    //
	public function index(){
	
	}
	
	public function create() {
		return view('files.create');
	}
	
	public function store(Request $request) {
		//$file->ipaddress=$request->ipaddress;

	}

	public function show($fileid) {
		//$file=File::find($fileid);
		//return view(fileshowfile, $file =>$file );
	}
	
	public function destroy($id) {
		
	}
}
