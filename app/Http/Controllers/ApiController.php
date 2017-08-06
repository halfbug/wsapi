<?php

namespace App\Http\Controllers;

use App\response;
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





    public function files(Request $request)
    {
        if ($request->user())
            $files = File::where('user_id', $$request->user()->id)->whereNull("parent_id")->orderBy('id', 'desc')->get();
        else
            $files = File::where("ipaddress",$request->ip())->whereNull("parent_id")->orderBy('id', 'desc')->get();

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

            if (\App\File::where("name", $photo->getClientOriginalName())->where("ipaddress", $request->ipaddress)->count() < 1) {
                $fileModel = new File();
                $fileModel->name = $photo->getClientOriginalName();
                $fileModel->user_id = isset($request->user()->id) ? $request->user()->id : null;
                $fileModel->ipaddress = $request->ip();
                $fileModel->status = 1;
                $fileModel->medium = 1;
                if (!isset($request->user()->id)) {
                    $fileModel->path = $photo->store('public/upload/' . $request->ipaddress);
//////                    ///////Todo check for free user quota
//////
                    $tot = File::whereNull("user_id")->with("user")->where("ipaddress", $request->ip())->count();

                    if ($tot > 10) {
                        return response()->json(array("error" => "Your free quota is expired"), 501);

                    }//endif
                } else {
                    $user_id = $request->user()->id;
                    $subscription = User::find($request->user()->id)->subscription()->active()->first();
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
            return response()->json("file not exist.", 404);
        }

    }

    public function downloadFile(Request $request)
    {

        $file = File::find($file_id)->where("user_id",$request->user()->id)
            ->orWhere("ipaddress",$request->ip())->get();
        if($file->getStatus() == "Processed"){
            $pfile = File::where("parent_id",$file_id)->first();

        }

        return response()->json(array("download_file_path"=>$pfile->path), 200);


    }

    public function searchFile(Request $request)
    {
        $files = File::where('name', 'LIKE', '%'.$request->name.'%')
            ->where("user_id",$request->user()->id)
            ->orWhere("ipaddress",$request->ip())->get();

        return response()->json(array("files"=>$files), 200);

    }

    public function fileInfo(Request $request,$file_id)
    {
        $files = File::where("id",$file_id)
            ->where("user_id",$request->user()->id)
//            ->orWhere("ipaddress",$request->ip())
            ->with("metadata")->get();

        return response()->json(array("files"=>$files), 200);

//        return response()->json(array("files"=>$file_id), 200);
    }




}
