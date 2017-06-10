<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Package;

class PackageController extends Controller
{
    public function index() {
		$packages=Package::all();
        return view('packages.index', compact('packages'));
	
	}
    public function create() {
         // $package= new Package();
        return view('packages.create')->with('state','add');
    }

	    public function store(Request $request) {
		 echo "in store method";// Package::create($request->all());
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
