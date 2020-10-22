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

        if ($event->organizer_id === $user->id) {
            $event->participants()->detach($participant);
        }

        return redirect()->route('events.show', $event->id);
    }
}
