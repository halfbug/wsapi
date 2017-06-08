<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index(){
        return view('profile.index');
	
	}
	public function show($user_id) {
        $user = User::find($user_id);
        return view('profile.index')->with('user', $user);
    }
	
	
    public function edit($user_id) {
        $user = User::find($user_id);
        return view('profile.edit')->with('user', $user);
    }
	
	
    public function update(Request $request, $user_id) {
        $user = User::find($user_id);
        if ($request->type == 'detail') {
            $user->name = $request->name;
            $user->description = $request->description;
        } elseif ($request->type == 'cpasword') {
            if ($request->password == $request->password_confirmation) {
                $user->password = bcrypt($request->password);
            }
        } elseif ($request->type == 'dp') {
//            return var_dump($request->file('avatar'));
            $path = $request->file('avatar')->store('avatar/'.$request->user()->id,'public'); 
//            Storage::setVisibility($path, 'public');
            $user->avatar = $path;
        }
        $user->save();
        return back()->with('success', 'Avatar Uploaded successfully.');
    }
    public function destroy(User $user) {
        //
    }



}
