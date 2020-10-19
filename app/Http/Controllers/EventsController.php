<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function upcomingEvents()
    {
        return inertia('Events/UpcomingEvents', [
            'events' => Auth::user()->events,
        ]);
    }

    public function show(int $id)
    {
        $event = Event::findOrFail($id);

        return inertia('Events/EventDetail', ['event' => $event]);
    }

    public function myEvents()
    {
        return inertia('Events/MyEvents', [
            'events' => Auth::user()->ownedEvents,
        ]);
    }

    public function previousEvents()
    {
        return inertia('Events/PreviousEvents', [
            'events' => [],
        ]);
    }

    public function create()
    {
        return inertia('Events/CreateEvent');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|min:6',
            'description' => 'string',
            'datetime' => 'required|date',
            'location' => 'required|string',
        ]);
        $data['datetime'] = Carbon::parse($data['datetime']);

        $user = Auth::user();

        $event = new Event($data);
        $event->organizer_id = $user->id;
        $event->save();
        $event->participants()->attach($user);

        return redirect()->route('events.show', $event->id);
    }
}
