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
    public function FrontIndex()
    {
        $user = session('user_id');
        $Acceptevents = Event::where('status', 'valide')->simplePaginate(3);



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
    public function search(Request $request)
    {
        // Search by title
        $query = Event::where('status', 'valide');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('titre', 'like', "%$search%");
        }

        // Apply pagination
        $Acceptevents = $query->simplePaginate(3);
        $user = session('user_id');

        return view('fontOffice.index', [
            'Acceptevents' => $Acceptevents,
            'user' => $user,
        ]);
    }
    public function filter(Request $request)
    {
        // Search by title
        $query = Event::where('status', 'valide');

        if ($request->has('category')) {
            $search = $request->input('category');
            $query->where('category_id', 'like', "%$search%");
        }

        // Apply pagination
        $Acceptevents = $query->simplePaginate(3);
        $user = session('user_id');
        $categories = Category::all();

        return view('fontOffice.index', [
            'Acceptevents' => $Acceptevents,
            'categories' => $categories,
            'user' => $user,
        ]);
    }
}
