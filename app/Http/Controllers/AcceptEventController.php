<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Event;

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
    public function FrontIndex()
    {
        $Acceptevents = Event::where('status', 'valide')->get();

        return view('fontOffice.index',[
            'Acceptevents' => $Acceptevents,
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
