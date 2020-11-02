<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Auth;
use Carbon\Carbon;
use Illuminate\Database\Query\Expression;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function upcomingEvents()
    {
        return inertia('Events/UpcomingEvents', [
            'events' => Auth::user()->events,
        ]);
    }

    public function show(Event $event)
    {
        $user = Auth::user();
        $event = $event->load('participants');

        $user_is_one_of_participants = $event->participants()->find($user->id);
        $join_secret = request('link');

        if ($user_is_one_of_participants) {
            if ($join_secret) {
                abort(404);
                return;
            }

            $data = ['event' => $event];
            if ($event->organizer_id === $user->id) {
                $data['join_secret'] = $event->join_secret;
            }

            return inertia('Events/EventDetail', $data);
        } elseif ($join_secret) {
            if ($event->join_secret !== request('link')) {
                abort(404);
                return;
            }
            $event->participants()->attach($user);

            return redirect()->route('events.show', $event->id);
        } else {
            return redirect()->route('index');
        }
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

    public function delete(Event $event)
    {
        $user = Auth::user();

        if ($user->can('delete', $event)) {
            $event->delete();
        } else {
            $event->participants()->detach($user);
        }

        return redirect()->route('events');
    }

    public function generateLink(Event $event)
    {
        $user = Auth::user();

        if ($event->organizer_id === $user->id) {
            $event->join_secret = new Expression('LEFT(MD5(RAND()), 30)');
            $event->save();
        }

        return redirect()->route('events.show', $event->id);
    }
}
