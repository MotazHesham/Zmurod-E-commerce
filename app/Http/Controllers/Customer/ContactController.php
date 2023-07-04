<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class ContactController extends Controller
{
    function index() {
        return view('frontend.customer.contact');
    }

    function store(Request $request)
    {
      // Validate the form input
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        // Create a new Message instance and set the attributes
        $message = Message::create($validatedData);

        // Save the message to the database
        $message->save();

        // Return a success response
        return redirect()->with('success', 'Message sent successfully');
    }
}

