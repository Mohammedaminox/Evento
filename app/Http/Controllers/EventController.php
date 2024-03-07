<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {

        $user = session('user_id');
        // dd($user);
        $events = Event::all()->where('user_id', $user);
        $categories = Category::all();

        return view('events', [
            'events' => $events,
            'user' => $user,
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
            'location' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('Pback/assets/images'), $imageName);
        }

        // Event::create($request->all());

        Event::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'location' => $request->location,
            'date' => $request->date,
            'typeAccept' => $request->typeAccept,
            'places' => $request->places,
            'image' => $imageName,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
        ]);



        return redirect('event')->with('success', 'event created successfully.');
    }
    public function update(Request $request, Event $event)
    {

        // $request->validate([
        //     'titre' => 'required|max:255',
        //     'description' => 'required',
        //     'date' => 'required',
        //     'typeAccept' => 'required',
        //     'places' => 'required',
        //     'location' => 'required',
        //     'image' => 'image|mimes:jpeg,png,jpg,gif',
        //     'category_id' => 'required|exists:categories,id',
        // ]);

        // Update the event attributes
        $event->fill($request->only(['titre', 'description', 'date', 'typeAccept', 'places', 'location', 'category_id']));


        if ($request->hasFile('image')) {
            // Save the image
            $imageName = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('Pback/assets/images'), $imageName);
            $event->image = $imageName;
        }

        $event->save();

        return redirect('event')->with('success', 'Event updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        if ($event->image) {
            $imagePath = 'Pback/assets/images/' . $event->image;
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
        }
        $event->delete();
        return redirect('event')
            ->with('success', 'event deleted successfully.');
    }
}
