<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Auth;
use App\Package;

class PackageController extends Controller
{
    public function index() {
	echo "klsadhad";
	
	}
    public function create() {
         // $package= new Package();
        return view('packages.create')->with('state','add');
    }

	    public function store(Request $request) {
		 // Package::create($request->all());
		 // echo $request->name;
		//  echo $request->description;
		 // echo $request->createdate;
		  //  echo $request->enddate;
		//  echo $request->filecount;
		//  echo $request->resetcount;
		//  echo $request->price;
		  //echo $request->get('discount');
		 // echo $request->get('status');
         //return redirect()->route('packageslist')->with('success','Package created successfully');//return view('packages.create')->with('state','add');
    }

}
