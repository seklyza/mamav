<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStoreEvent()
    {
        /** @var User */ $user = User::factory()->create();
        /** @var Event */ $event = Event::factory()->make();
        $event->datetime = Carbon::instance($event->datetime);
        $response = $this->actingAs($user)->post(route('events.store'), $event->toArray());
        $response->assertRedirect(route('events.show', 1));

        /** @var Event */ $saved_event = Event::find(1)->first();
        $this->assertNotNull($saved_event);

        $this->assertEquals($saved_event->organizer->id, $user->id);
        $this->assertEquals($saved_event->participants()->first()->id, $user->id);
    }

    public function testJoinEvent()
    {
        /** @var Event */ $event = Event::factory()->for(User::factory(), 'organizer')->create()->first();
        /** @var User */ $participant_to_join = User::factory()->create();

        $response = $this->actingAs($participant_to_join)->get(route('events.show', ['event' => $event->id, 'link' => $event->join_secret]));

        $response->assertRedirect(route('events.show', $event->id));
        $this->assertDatabaseCount('event_participant', 1);
        $this->assertEquals($participant_to_join->id, $event->participants()->first()->id);
    }

    public function testLeaveEvent()
    {
        function getRandomParticipant(Event $event): User
        {
            /** @var User */ $participant = $event->participants()->get()->random();

            if ($participant->id === $event->organizer_id) {
                return getRandomParticipant($event);
            }

            return $participant;
        }

        $this->seed(DatabaseSeeder::class);

        /** @var Event */ $event = Event::first();
        $participant = getRandomParticipant($event);

        $response = $this->actingAs($participant)->delete(route('events.delete', $event->id));
        $response->assertRedirect(route('events'));

        // assert no such connection between the event and the participant exists anymore
        $this->assertDatabaseMissing('event_participant', ['event_id' => $event->id, 'participant_id' => $participant->id]);

        // assert that the event still exists
        $event->refresh();
    }

    public function testDeleteEvent()
    {
        $this->seed(DatabaseSeeder::class);
        /** @var Event */ $event = Event::first();
        $user = $event->organizer;

        $response = $this->actingAs($user)->delete(route('events.delete', $event->id));
        $response->assertRedirect(route('events'));

        $this->expectException(ModelNotFoundException::class);
        $event->refresh();
    }
}
