<?php

namespace Database\Factories;

use App\Models\Shipment;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\ShipmentStatus;

/**
 * @extends Factory<Shipment>
 */
class ShipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cities = ['Karachi', 'Lahore', 'Islamabad', 'Peshawar', 'Quetta', 'Multan', 'Faisalabad'];
        [$from, $to] = fake()->randomElements($cities, 2);

        return [
            'tracking_number' => 'SHP-' . strtoupper(fake()->unique()->bothify('????####')),
            'customer_name'   => fake()->name(),
            'customer_phone'  => fake()->numerify('03#########'),
            'origin'          => $from,
            'destination'     => $to,
            'weight'          => fake()->randomFloat(2, 0.5, 500),
            'status'          => fake()->randomElement(ShipmentStatus::cases()),
            'created_at' => fake()->dateTimeBetween('-6 days', 'now'),
            'updated_at' => fn (array $attributes) => $attributes['created_at'],
        ];
    }
}
