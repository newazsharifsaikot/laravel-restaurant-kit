<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Notifications\InformToReservedPerson;
use App\Reservation;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ReservationController extends Controller
{
    public function index(){
        $reservations = Reservation::latest()->get();
        return view('admin.reservation.index')->with(compact('reservations'));
    }

    public function destroy($id){
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        Toastr::success('Reservation Deleted Successfully', 'SUccess');
        return redirect()->back();
    }

    public function publish($id){
        $reservation = Reservation::findOrFail($id);
        if ($reservation->status == false){
            $reservation->status = true;
            $reservation->save();
            Notification::route('mail', $reservation->email)
                ->notify(new InformToReservedPerson($reservation));
            Toastr::success('Reservation Published Successfully', 'SUccess');
            return redirect()->back();
        }
    }

    public function pending($id){
        $reservation = Reservation::findOrFail($id);
        if ($reservation->status == true){
            $reservation->status = false;
            $reservation->save();
            Toastr::success('Reservation Confirm Successfully', 'SUccess');
            return redirect()->back();
        }
    }


}
