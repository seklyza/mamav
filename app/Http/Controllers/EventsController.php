<?php

namespace App\Http\Controllers;

use Auth;

class EventsController extends Controller
{
    public function upcomingEvents()
    {
        return inertia('Dashboard', [
            'events' => Auth::user()->events
        ]);
    }
}
