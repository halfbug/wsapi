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
		//echo $request->email;
        \Mail::send('emails.contact',
            array(
                'name' => $request->name,
                'email' => $request->email,
                'user_message' => $request->message
            ), function($message)
        {
            $message->from('testemail@mail.com');
            $message->to('testemail@mail.com', 'Admin')->subject('Website Feedback');
        });

      return \Redirect::route('contact')->with('message', 'Thanks for contacting us!');    
	  }
	
}
 