<?php

namespace App\Http\Controllers;

use App\Reservation;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(Request $request){
       $this->validate($request,[
          'name' => 'required|string',
          'email' => 'bail|required|email|unique:reservations',
          'phone' => 'bail|required|numeric|min:11|unique:reservations',
          'date_time' => 'required',
       ]);
       $reservation = new Reservation();
        $reservation->name = $request->name;
        $reservation->email = $request->email;
        $reservation->phone = $request->phone;
        $reservation->date_time = $request->date_time;
        $reservation->body = $request->message;
        $reservation->save();
        Toastr::success('Your Table Reservation Successfully', 'Success');
        return redirect()->back();
    }
}
