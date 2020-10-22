<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Event::factory(20)->make()->each(function (Event $event) {
            $participants = User::all()->random(8)->pluck('id');
            $event->organizer_id = $participants->first();
            $event->save();
            $event->participants()->attach($participants);
        });
    }
}
