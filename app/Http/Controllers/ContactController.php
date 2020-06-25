<?php

namespace App\Http\Controllers;

use App\Contact;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request){
        $this->validate($request,[
           'name' => 'required|string',
           'email' => 'required|email|unique:contacts',
           'subject' => 'required|string',
           'message' => 'required|string',
        ]);

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save();
        Toastr::success('Your Contact Details Sent Successfully', 'Success');
        return redirect()->back();
    }
}
