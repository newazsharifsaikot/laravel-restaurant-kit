<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        $contacts = Contact::latest()->get();
        return view('admin.contact.index')->with(compact('contacts'));
    }

    public function destroy($id){
        $contact = Contact::findOrFail($id);
        $contact->delete();
        Toastr::success('Contact Deleted Successfully', 'Success');
        return redirect()->back();

    }

    public function details($id){
        $contact = Contact::findOrFail($id);
        return view('admin.contact.show')->with(compact('contact'));
    }

}
