<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        $users = User::all();
        $categories = Category::all();

        return view('events', [
            'events' => $events,
            'users' => $users,
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|max:255',
            'description' => 'required',
            'date' => 'required',
            'typeAccept' => 'required',
            'places' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif',
            'categories' => 'array',
            'user_id' => 'required|exists:users,id',
        ]);

        $imageName = null;
        if($request->hasFile('images')){
            $imageName = $request->file('images')->getClientOriginalName();
            $request->file('images')->move(public_path('Pback/assets/images'), $imageName);
        }

        $event = Event::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'date' => $request->date,
            'typeAccept' => $request->typeAccept,
            'places' => $request->places,
            'user_id' => $request->user_id,
            'images' => $imageName,
        ]);

        if ($request->has('categories')) {
            $event->categories()->attach($request->categories);
        }

        return redirect('event')->with('success', 'event created successfully.');
    }
}
