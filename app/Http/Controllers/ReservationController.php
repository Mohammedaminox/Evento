<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;


class ReservationController extends Controller
{
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'event_id' => 'required|exists:events,id',
            'status' => 'required',
        ]);

        $reservation = Reservation::create([
            'user_id' => $request->user_id,
            'event_id' => $request->event_id,
            'status' => $request->status,
        ]);

        $reservation->save();

        return back();
    }

    public function AcceptReservation(){
        $reservations = Reservation::where('status', 'pending')->get();

        return view('AcceptReservation',[
            'reservations' => $reservations,
        ]);
    }

    public function StatusAccepted($id){
        $reservations = Reservation::find($id);
        if ($reservations && $reservations->status === 'pending') {
            $reservations->status = 'accepted';
            $reservations->save();
        }
        return back();

    }
    public function StatusRefused($id){
        $reservations = Reservation::find($id);
        if ($reservations && $reservations->status === 'pending') {
            $reservations->status = 'refused';
            $reservations->save();
        }
        return back();

    }
}
