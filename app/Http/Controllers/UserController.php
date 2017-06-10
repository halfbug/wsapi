<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with(array('filesCount','roles'))->get()->toArray();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if ($request->type == 'detail') {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->description = $request->description;
        } elseif ($request->type == 'cpasword') {
            if ($request->password == $request->password_confirmation) {
                $user->password = bcrypt($request->password);
            }
        } elseif ($request->type == 'dp') {
           $path = $request->file('avatar')->store('avatar/'.$request->user()->id,'public'); 
           $user->avatar = $path;
        }
        $user->save();
        return back()->with('success', 'User Info successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $role)
    {
        $user = User::find($id);
        User::destroy($id);
        return back()->with('role', $role)->with('success', $user->name . ' has been deleted successfully.');
    }

    /**
    *   Filters the user list w.r.t user role
    *   @param  string $role
    */
    public function filtergrid($role)
    {
        return back()->with('role', $role);
    }

}
