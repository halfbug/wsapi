<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FileController extends Controller
{
    //
	public function index(){
	
	}
	
	public function create() {
		$file= new File;
		//return view(file.create)->with('filedetail', $file);
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
