<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Event;

use Barryvdh\DomPDF\Facade\Pdf;


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

        // Check if status is 'accepted' and call generatePdf() if true
        if ($request->status === 'accepted') {
        $this->generatePdf($reservation);
    }

        return back();
    }

    public function AcceptReservation()
    {
        $reservations = Reservation::where('status', 'pending')->get();

        return view('AcceptReservation', [
            'reservations' => $reservations,
        ]);
    }

    public function StatusAccepted($id)
    {
        $reservations = Reservation::find($id);
        if ($reservations && $reservations->status === 'pending') {
            $reservations->status = 'accepted';
            $reservations->save();
        }

            // Call generatePdf() after status update
            $this->generatePdf();

        return back();
    }
    public function generatePdf()
    {
        // Retrieve accepted reservations
        $reservations = Reservation::where('status', 'accepted')->get();
    
        // Loop through each accepted reservation
        foreach ($reservations as $reservation) {
            // Prepare data for PDF
            $data = [
                'titre' => 'Evento Ticket',
                'ticket_id' => $reservation->id,
                'username' => $reservation->user->name,
                'email' => $reservation->user->email,
                'event' => $reservation->event->titre,
                'location' => $reservation->event->location,
                'description' => $reservation->event->description,
                'date' => $reservation->event->date,
            ];
    
            // Generate PDF and send email
            $pdf = Pdf::loadView('PDF.PDFView', $data)->setPaper('a4', 'landscape');
            Mail::send('emails.PDF_ToMail', $data, function ($message) use ($data, $pdf) {
                $message->to($data["email"], $data["email"])
                        ->subject($data["titre"])
                        ->attachData($pdf->output(), "Ticket.pdf");
            });
        }
    }
    
    public function StatusRefused($id)
    {
        $reservations = Reservation::find($id);
        if ($reservations && $reservations->status === 'pending') {
            $reservations->status = 'refused';
            $reservations->save();
        }
        return back();
    }
}
