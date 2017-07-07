<?php

namespace App\Http\Controllers;

use App\Package;
use App\Subscription;
use App\User;
use App\Discount;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return view('packages.index', compact('packages'));

    }

    public function create()
    {
        $discounts = \App\Discount::all();

        return view('packages.create')->with(compact('discounts'));
    }

    public function pricetable()
    {
        $enabledpackages = Package::all()->where('status', '=', 1);
        return view('frontend.pricetable')->with(compact('enabledpackages'));

		
		
		
	}
	public function store(Request $request) {
		 $package= new Package;
		 $discount= new Discount;
		  $package->name=$request->name;
		  $package->description= $request->description;
		  //$package->start_date= date("Y-m-d 00:00:00",strtotime($request->createdate));
		  //$package->end_date= date("Y-m-d 00:00:00",strtotime($request->enddate));
		  $package->files_count= $request->filecount;
		  $package->reset_count= $request->resetcount;
		  $package->price= $request->price;
		  $package->status= $request->get('status');
		  //$package->type= $request->get('ptype');
		  $package->type= $request->ptype;
		  if($package->type==1){
			 $package->duration="months";
 			 $package->duration_count=$request->pmonth;

		  }else {
			 $package->duration="Unlimited";
		  }
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



    public function edit($package_id)
    {
        $package = Package::find($package_id);
        $discounts = \App\Discount::all();
        $discount = \App\Discount::find($package->discount_id);
        return view('packages.edit')->with(compact('package'))->with(compact('discount'))->with(compact('discounts'));
    }

    public function update(Request $request, $package_id)
    {
        $discounts = \App\Discount::all();
        $package = Package::find($package_id);
        $package->name = $request->name;
        $package->description = $request->description;
        $package->start_date = date("Y-m-d 00:00:00", strtotime($request->createdate));
        $package->end_date = date("Y-m-d 00:00:00", strtotime($request->enddate));
        $package->files_count = $request->filecount;
        $package->reset_count = $request->resetcount;
        $package->price = $request->price;
        $package->status = $request->get('status');
        $package->discount_id = $request->get('discount');
        $package->save();
        $discount = \App\Discount::find($package->discount_id);
        return view('packages.edit')->with(compact('package'))->with(compact('discount'))->with(compact('discounts'));

    }

    public function assign()
    {
        $packages = Package::all();
        $users = \App\User::all();
        return view('packages.assign')->with(compact('packages'))->with(compact('users'));

    }

    public function assignpackage(Request $request)
    {
        //echo "assigned";
        $package = Package::find($request->pkg);
        $user_id = $request->user;
//       TODO paypal payment

        if (\App\Subscription::where('user_id', $request->user)->where("status", '1')->count() < 1) {
            \App\Subscription::where('user_id', $request->user)->where("status", '1')->update(["status" => '0']);
        }
        $subscribe = new \App\Subscription();

        $subscribe->package_id = $package->id;
        $subscribe->user_id = $request->user;
        $subscribe->files_upload_balance = $package->file_count;
        $subscribe->start_date = Carbon::now();
        if ($package->getType() == "Monthly")
            $subscribe->end_date = $subscribe->start_data->addMonths($package->duration_count);
        $subscribe->save();


        return back()->with('success', '$user->name is subscribed to package.');

    }

}
