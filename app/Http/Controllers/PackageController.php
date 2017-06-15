<?php

namespace App\Http\Controllers;

use App\Package;
use App\User;
use App\Discount;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index() {
		$packages=Package::all();
        return view('packages.index', compact('packages'));
	
	}
    public function create() {
		$discounts=\App\Discount::all();
		
        return view('packages.create')->with('state','add')->with(compact('discounts'));
    }

	public function store(Request $request) {
		 $package= new Package;
		 
		  $package->name=$request->name;
		  $package->description= $request->description;
		  $package->start_date= $request->createdate;
		  $package->end_date= $request->enddate;
		  $package->files_count= $request->filecount;
		  $package->reset_count= $request->resetcount;
		  $package->price= $request->price;
		  $package->discount_id= $request->get('discount');
		  $package->status= $request->get('status');
		  $package->save();
         return redirect()->route('packageslist')->with('success','Package created successfully');
    }
	public function assign() {
		$packages=Package::all();
		$users=\App\User::all();
			return view('packages.assign')->with(compact('packages'))->with(compact('users'));
			
		}

	public function assignpackage() {
        echo "assigned";
		//return view('packages.assign');
			
		}

}
