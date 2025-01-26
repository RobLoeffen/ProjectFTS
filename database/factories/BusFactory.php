<?php

namespace Database\Factories;

use App\Models\Bus;
use App\Models\Festival;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bus>
 */
class BusFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'departure_location' => fake()->city(),
            'arrival_time' => fake()->time(),
            'departure_time' => fake()->time(),
            'price' => fake()->randomDigitNotZero(),
        ];
    }
}
