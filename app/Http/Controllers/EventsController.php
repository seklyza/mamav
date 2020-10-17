<?php

namespace App\Http\Controllers;

use Auth;

class EventsController extends Controller
{
    public function upcomingEvents()
    {
        return inertia('UpcomingEvents', [
            'events' => Auth::user()->events,
        ]);
    }

    public function myEvents()
    {
        return inertia('MyEvents', [
            'events' => Auth::user()->ownedEvents,
        ]);
    }

    public function previousEvents()
    {
        return inertia('PreviousEvents', [
            'events' => [],
        ]);
    }

    public function createEvent()
    {
        return inertia('CreateEvent');
    }
}
