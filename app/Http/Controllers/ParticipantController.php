<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use Auth;

class ParticipantController extends Controller
{
    public function delete(Event $event, User $participant)
    {
        $user = Auth::user();

        if ($event->organizer_id === $user->id && $event->participants()->find($participant->id)) {
            $event->participants()->detach($participant);
        }

        return redirect()->route('events.show', $event->id);
    }

    public function makeOrganizer(Event $event, User $participant)
    {
        $user = Auth::user();

        if ($event->organizer_id === $user->id && $event->participants()->find($participant->id)) {
            $event->organizer_id = $participant->id;
            $event->save();
        }

        return redirect()->route('events.show', $event->id);
    }
}
