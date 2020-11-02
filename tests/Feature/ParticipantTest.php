<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
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
        /** @var User */ $participant = $event->participants()->get()->where('id', '!=', $organizer->id)->first();

        $response = $this->actingAs($organizer)->delete(route('events.participants.delete', [$event->id, $participant->id]));
        $response->assertRedirect(route('events.show', $event->id));

        $this->assertDatabaseMissing('event_participant', ['event_id' => $event->id, 'participant_id' => $participant->id]);
    }

    public function testRemoveParticipantNotAuthenticatedAsTheOrganizer()
    {
        $this->seed(DatabaseSeeder::class);
        /** @var Event */ $event = Event::first();
        /** @var User */ [, $user, $participant] = $event->participants()->get()->where('id', '!=', $event->organizer_id)->all();

        $response = $this->actingAs($user)->delete(route('events.participants.delete', [$event->id, $participant->id]));
        $response->assertStatus(403);

        $this->assertDatabaseHas('event_participant', ['event_id' => $event->id, 'participant_id' => $participant->id]);
    }

    public function testMakeAParticipantTheOrganizerOfTheEvent()
    {
        $this->seed(DatabaseSeeder::class);
        /** @var Event */ $event = Event::first();
        $organizer = $event->organizer;
        /** @var User */ $newOrganizer = $event->participants()->get()->where('id', '!=', $organizer->id)->first();

        $response = $this->actingAs($organizer)->post(route('events.participants.make-organizer', [$event->id, $newOrganizer->id]));
        $response->assertRedirect(route('events.show', $event->id));

        $event->refresh();

        $this->assertEquals($event->organizer_id, $newOrganizer->id);
    }

    public function testMakeAParticipantTheOrganizerOfTheEventNotAuthenticatedAsTheOrganizer()
    {
        $this->seed(DatabaseSeeder::class);
        $this->seed(DatabaseSeeder::class);
        /** @var Event */ $event = Event::first();
        /** @var User */ [, $user, $newOrganizer] = $event->participants()->get()->where('id', '!=', $event->organizer_id)->all();

        $response = $this->actingAs($user)->post(route('events.participants.make-organizer', [$event->id, $newOrganizer->id]));
        $response->assertStatus(403);

        $this->assertNotEquals($event->organizer_id, $newOrganizer->id);
    }
}
