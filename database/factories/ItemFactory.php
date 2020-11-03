<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $randQuantity = rand(0, 10);
        $quantity = $randQuantity >= 5 ? $randQuantity : null;

        return [
            'name' => $this->faker->sentence(3),
            'description' => rand(0, 10) >= 5 ? $this->faker->sentence(7) : null,
            'quantity' => $quantity,
            'event_id' => Event::get()->pluck('id')->random()
        ];
    }
}
