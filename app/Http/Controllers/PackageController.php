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
		
        return view('packages.create')->with(compact('discounts'));
    }

	public function store(Request $request) {
		 $package= new Package;
		 $discount= new Discount;
		  $package->name=$request->name;
		  $package->description= $request->description;
		  $package->start_date= date("Y-m-d 00:00:00",strtotime($request->createdate));
		  $package->end_date= date("Y-m-d 00:00:00",strtotime($request->enddate));
		  $package->files_count= $request->filecount;
		  $package->reset_count= $request->resetcount;
		  $package->price= $request->price;
		  $package->status= $request->get('status');
		  
			//if add new discount do this
		  if($request->get('discount')==0){
			 // echo "add new discount here";
		  $discount->name=$request->discname;
		  $discount->description= $request->discountdesc;
		  $discount->start_date= date("Y-m-d 00:00:00",strtotime($request->newstartdate));
		  $discount->end_date= date("Y-m-d 00:00:00",strtotime($request->newenddate));
		  $discount->amount= $request->amount;
		  $discount->duration= $request->duration;
		  $discount->type= $request->get('newtype');
		  $discount->status= $request->get('discountstatus');		  
		  $discount->save();
		  $discount_id=$discount->id;
  		  $package->discount_id= $discount_id;
}
		  else {
  		  $package->discount_id= $request->get('discount');
		  }

		  $package->save();
         return redirect()->route('packageslist')->with('success','Package created successfully');
    }
	public function edit($package_id) {
 		$package=Package::find($package_id);
 		$discounts=\App\Discount::all();
        $discount = \App\Discount::find($package->discount_id);
      return view('packages.edit')->with(compact('package'))->with(compact('discount'))->with(compact('discounts'));
	}
	public function update(Request $request, $package_id) {
 		$discounts=\App\Discount::all();
 		  $package=Package::find($package_id);
		  $package->name=$request->name;
		  $package->description= $request->description;
		  $package->start_date= date("Y-m-d 00:00:00",strtotime($request->createdate));
		  $package->end_date= date("Y-m-d 00:00:00",strtotime($request->enddate));
		  $package->files_count= $request->filecount;
		  $package->reset_count= $request->resetcount;
		  $package->price= $request->price;
		  $package->status= $request->get('status');
  		  $package->discount_id= $request->get('discount');
		  $package->save();
        $discount = \App\Discount::find($package->discount_id);
      return view('packages.edit')->with(compact('package'))->with(compact('discount'))->with(compact('discounts'));
		  
	}
	
	public function assign() {
		$packages=Package::all();
		$users=\App\User::all();
			return view('packages.assign')->with(compact('packages'))->with(compact('users'));
			
		}

	public function assignpackage(Request $request) {
        //echo "assigned";
		$package_id=$request->pkg;
		$user_id=$request->user;
        $user = \App\User::find($user_id);
		$user->package_id=$package_id;
		$user->save();
        return back()->with('success', '$user->name is assigned package.');
		
		}

}
