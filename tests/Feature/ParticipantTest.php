<?php

namespace Tests\Feature;

use App\Models\Event;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ParticipantTest extends TestCase
{
    use RefreshDatabase;

    public function testRemoveParticipant()
    {
        $this->seed(DatabaseSeeder::class);
        /** @var Event */ $event = Event::get()->random();
        $organizer = $event->organizer;
        /** @var \App\Models\User */ $participant = $event->participants()->get()->where('id', '!=', $organizer->id)->first();

        $response = $this->actingAs($organizer)->delete(route('events.participants.delete', [$event->id, $participant->id]));
        $response->assertRedirect(route('events.show', $event->id));

        $this->assertDatabaseMissing('event_participant', ['event_id' => $event->id, 'participant_id' => $participant->id]);
    }

    public function testRemoveParticipantNotAsOrganizer()
    {
        $this->seed(DatabaseSeeder::class);
        /** @var Event */ $event = Event::first();
        /** @var \App\Models\User */ [, $user, $participant] = $event->participants()->get()->where('id', '!=', $event->organizer_id)->all();

        $response = $this->actingAs($user)->delete(route('events.participants.delete', [$event->id, $participant->id]));
        $response->assertRedirect(route('events.show', $event->id));

        $this->assertDatabaseHas('event_participant', ['event_id' => $event->id, 'participant_id' => $participant->id]);
    }
}
