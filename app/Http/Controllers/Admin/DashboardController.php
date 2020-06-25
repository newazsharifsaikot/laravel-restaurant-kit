<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Contact;
use App\Http\Controllers\Controller;
use App\Item;
use App\Reservation;
use App\Slider;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $slider = Slider::where('status', true)->count();
        $category = Category::where('status',true)->count();
        $item = Item::where('status', true)->count();
        $reservation = Reservation::where('status', false)->count();
        $contact = Contact::all()->count();
        $reservations = Reservation::latest()->get();
        return view('admin.dashboard')->with(compact('slider','category','item','reservation','contact','reservations'));
    }
}
