<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Auth;
use App\File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\UserMeta;
use App\Notifications\FileProcessed;


class ApiController extends Controller
{

    public function index()
    {

        return view('frontend.api-index');
    }

    public function clients()
    {
        $users = User::all();
        return view('api.index')->with(compact('users'));
    }

    public function files($user_id = null)
    {
        if ($user_id)
            $files = File::where('user_id', $user_id)->orderBy('id', 'desc')->get();
        else
            $files = File::orderBy('id', 'desc')->get();

        return $files->transform(function ($item, $key) {
            $item->status = $item->getStatus();
//            $item->user_id = User::select("name","email","ip")->where("id",$item->user_id)->get();
            return $item;
        });

//        return $files;
    }

    public function uploadFile(Request $request)
    {
        if ($request->hasFile('photo')) {
//            return $request->all();
            $photo = $request->photo;
            if (\App\File::where("name", $photo->getClientOriginalName())->where("ipaddress", $request->ipaddress)->count() < 1)
            {
                $fileModel = new File();
                $fileModel->name = $photo->getClientOriginalName();
                $fileModel->user_id = isset($request->user_id) ? $request->user_id : null;
                $fileModel->ipaddress = $request->ipaddress;
                $fileModel->status = 1;
                if (!isset($request->user_id)) {
                    $fileModel->path = $photo->store('public/upload/' . $request->ipaddress);
//////                    ///////Todo check for free user quota
//////
                    $tot = File::whereNull("user_id")->with("user")->where("ipaddress", $ip)->count();

                    if ($tot > 10) {
                        return response()->json(array("error" => "Your free quota is expired"), 501);

                    }//endif
                }
                else {
                    $user_id = $request->user_id;
                    $subscription = User::find($request->user_id)->subscription()->active()->first();
//                    // no package subscribed by registered user
                    if ($subscription == null) {
                        $fileModel->path = $photo->store('public/upload/' . $user_id);
                    } else {
                        //                        dd($subscription);
                        //                        dd($subscription->files_upload_balance );
                        if ($subscription->files_upload_balance > 0) {
//                            //                             dd($subscription);
                            $fileModel->path = $photo->store('public/upload/' . $user_id);
                            $subscription->files_upload_balance = $subscription->setUploadBalance();
                            $subscription->save();
                        } else
                            return response()->json(array("error" => "Package Expire"), 501);
                    }
                }

                $fileModel->save();
                return response()->json(array($fileModel), 200);
            } else {
                return response()->json("file already exist.", 406);
            }

        } else {
            return "OOPs!! Error!!";
        }

    }


}
