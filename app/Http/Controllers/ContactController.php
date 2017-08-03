<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function create()
    {
        return view('frontend.contact');
    }

    public function store(Request $request)
    {
		$user = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'user_message' => $request->message
        ];

        \Mail::send('emails.contact', ['user' => $user], function($message) use ($user) {
           // $message->from($request->email, $request->name);
            $message->to('dev.zone.testdrive@gmail.com')->subject('Website Feedback');
        });

        return \Redirect::route('contact')->with('message', 'Thank you for contacting us!');    
	}
	
}
 