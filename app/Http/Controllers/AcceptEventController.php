<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Event;
use App\Models\Reservation;

class AcceptEventController extends Controller
{
    public function Acceptindex()
    {
        $Acceptuser = session('username');
        $Acceptevents = Event::where('status', 'invalide')->get();

        $Acceptcategories = Category::all();

        return view('AcceptEvent', [
            'Acceptevents' => $Acceptevents,
            'Acceptuser' => $Acceptuser,
            'Acceptcategories' => $Acceptcategories,
        ]);
    }
    public function FrontIndex(Request $request)
    {
        $user = session('user_id');
        $Acceptevents = Event::where('status', 'valide')->paginate(2); // Paginate results

        if ($request->ajax()) {
            return view('fontOffice.pagination', compact('Acceptevents'));
        }

        return view('fontOffice.index', [
            'Acceptevents' => $Acceptevents,
            'user' => $user,
        ]);
    }

    public function Approuve($id)
    {
        $Acceptevents = Event::find($id);

        if ($Acceptevents && $Acceptevents->status === 'invalide') {
            $Acceptevents->status = 'valide';
            $Acceptevents->save();
        }
        return back();
    }
}
