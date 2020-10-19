<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventsControllerTest extends TestCase
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
        $response->assertRedirect(route('events'));

        /** @var Event */ $saved_event = Event::find(1)->first();
        $this->assertNotNull($saved_event);

        $this->assertEquals($saved_event->organizer->id, $user->id);
        $this->assertEquals($saved_event->participants()->first()->id, $user->id);
    }
}
