<?php

namespace Database\Seeders;

use App\Models\Bus;
use App\Models\Festival;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Eigenaar ToetToet',
            'email' => 'employee@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Standaard'),
            'remember_token' => Str::random(10),
            'role'=>'employee'
        ]);

        User::factory()->create([
            'name' => 'Bart',
            'email' => 'bart@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Standaard'),
            'remember_token' => Str::random(10),
            'role'=>'customer'
        ]);

        User::factory(10)->create();
        Festival::factory()
            ->count(10)
            ->create()
            ->each(function ($festival) {
                $numberOfBuses = rand(1, 3);

                Bus::factory()
                    ->count($numberOfBuses)
                    ->create([
                        'festival_id' => $festival->id
                    ]);
            });
    }
}
