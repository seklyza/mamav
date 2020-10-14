<?php

namespace App\Http\Controllers;

use Auth;

class EventsController extends Controller
{
    public function upcomingEvents()
    {
        return inertia('EventsList', [
            'events' => Auth::user()->events,
            'title' => 'Upcoming Events'
        ]);
    }

    public function myEvents()
    {
        return inertia('EventsList', [
            'events' => Auth::user()->ownedEvents,
            'title' => 'My Events'
        ]);
    }

    public function previousEvents()
    {
        return inertia('EventsList', [
            'events' => [],
            'title' => 'Previous Events'
        ]);
    }
}
