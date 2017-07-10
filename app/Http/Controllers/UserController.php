<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
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
     * @param  string $role
     * @return \Illuminate\Http\Response
     */
    public function create($role)
    {
        return view('user.create')->with('role',$role);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    use RegistersUsers;

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        try
        {
            event(new Registered($user = $this->add($request->all())));
        }
        catch (\Exception $e) {
            abort(500, 'User Already Exist.');
        }

        return redirect()->route('users');
    }

     /**
     * Create a new user instance.
     *
     * @param  array  $data
     * @return User
     */
    protected function add(array $data)
    {
        $user=  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            
        ]);
        
        $user->roles()->attach($data['role']);
        
        return $user;
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
     * @param  string $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $role)
    {
        $user = User::find($id);
        User::destroy($id);
        return back()->with('role', $role)->with('success', 'User has been deleted successfully.');
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
