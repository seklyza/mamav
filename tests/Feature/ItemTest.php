<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class ItemTest extends TestCase
{
    use RefreshDatabase;

    public function testAddItemToEvent()
    {
        $this->seed();

        /** @var Event */ $event = Event::first();
        $user = $event->organizer;
        $name = Str::random(10);

        $response = $this->actingAs($user)->post(route('events.items.store', $event->id), ['name' => $name]);
        $response->assertRedirect(route('events.items', $event->id));

        $this->assertDatabaseHas('items', ['event_id' => $event->id, 'name' => $name]);
    }

    public function testAddItemToEventNotAsOrganizer()
    {
        $this->seed();

        /** @var Event */ $event = Event::first();
        $user = $event->participants()->get()->where('id', '!=', $event->organizer_id)->random();
        $name = Str::random(10);

        $response = $this->actingAs($user)->post(route('events.items.store', $event->id), ['name' => $name]);
        $response->assertStatus(403);

        $this->assertDatabaseMissing('items', ['event_id' => $event->id, 'name' => $name]);
    }

    public function testRemoveItemFromEvent()
    {
        $this->seed();
        /** @var Event */ $event = Event::first();
        $user = $event->organizer;
        /** @var Item */ $item = $event->items()->get()->random();

        $response = $this->actingAs($user)->delete(route('events.items.delete', [$event->id, $item->id]));

        $response->assertRedirect(route('events.items', $event->id));

        $this->assertDatabaseMissing('items', ['event_id' => $event->id, 'id' => $item->id]);
    }

    public function testRemoveItemFromEventNotAsOrganizer()
    {
        $this->seed();
        /** @var Event */ $event = Event::first();
        $user = $event->participants()->get()->where('id', '!=', $event->organizer_id)->random();
        /** @var Item */ $item = $event->items()->get()->random();

        $response = $this->actingAs($user)->delete(route('events.items.delete', [$event->id, $item->id]));

        $response->assertStatus(403);

        $this->assertDatabaseHas('items', ['event_id' => $event->id, 'id' => $item->id]);
    }
}
