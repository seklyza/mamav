<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DeleteItemRequest;
use App\Http\Requests\Items\AddItemRequest;

class ItemController extends Controller
{
    public function index(Event $event)
    {
        $this->authorize('view', $event);

        return inertia('Events/Items/EventItems', [
            'event' => $event->only(['id', 'name', 'items']),
            'canUpdate' => Auth::user()->can('update', $event),
        ]);
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

    public function updateQuantity(Request $request, Event $event, Item $item)
    {
        $this->authorize('update', $event);
        $data = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $item->update($data);

        return redirect()->route('events.items', $event->id);
    }
}
