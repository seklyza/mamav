<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteItemRequest;
use App\Http\Requests\Items\AddItemRequest;
use App\Models\Item;
use App\Models\Event;

class ItemController extends Controller
{
    public function index(Event $event)
    {
        return inertia('Events/Items/EventItems', ['event' => $event->only(['id', 'name', 'items'])]);
    }

    public function addItem(AddItemRequest $request)
    {
        $data = $request->validated();
        /** @var Event */ $event = session('event');

        $item = new Item($data);
        $item->event_id = $event->id;
        $item->save();

        return redirect()->route('events.items', $event->id);
    }

    public function deleteItem(DeleteItemRequest $request)
    {
        /** @var int */ $itemId = $request->route('item');
        Item::find($itemId)->delete();

        return redirect()->route('events.items', $request->route('event'));
    }
}
