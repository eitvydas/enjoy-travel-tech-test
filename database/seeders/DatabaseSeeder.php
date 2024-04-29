<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarHire;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $faker = Factory::create();

        foreach ([20, 29, 44, 68, 35] as $age) {
            User::factory()->create([
                'name' => $faker->name,
                'email' => $faker->email,
                'dob' => Carbon::now()->subYears($age),
                'created_at' => now()
            ]);
        }

        // Create test cars
        Car::insert([
            [
                'make' => 'Ford',
                'model' => 'Focus',
                'available' => 0,
                'day_rate' => 30,
                'young_driver_premium' => 10,
                'senior_driver_premium' => 10,
                'created_at' => now()
            ],
            [
                'make' => 'Ford',
                'model' => 'Fiesta',
                'available' => 1,
                'day_rate' => 20,
                'young_driver_premium' => 10,
                'senior_driver_premium' => 10,
                'created_at' => now()
            ],
            [
                'make' => 'BMW',
                'model' => 'i8',
                'available' => 1,
                'day_rate' => 100,
                'young_driver_premium' => 50,
                'senior_driver_premium' => 30,
                'created_at' => now()
            ],
            [
                'make' => 'Tesla',
                'model' => 'S',
                'available' => 0,
                'day_rate' => 90,
                'young_driver_premium' => 35,
                'senior_driver_premium' => 25,
                'created_at' => now()
            ],
            [
                'make' => 'Audi',
                'model' => 'TT',
                'available' => 1,
                'day_rate' => 50,
                'young_driver_premium' => 15,
                'senior_driver_premium' => 15,
                'created_at' => now()
            ]
        ]);

        CarHire::insert([
            [
                'user_id' => 1,
                'car_id' => 1,
                'hire_start_date' => Carbon::now()->subDays(10),
                'hire_end_date' => Carbon::now()->subDays(5),
                'active' => 0,
                'created_at' => now()
            ],
            [
                'user_id' => 3,
                'car_id' => 4,
                'hire_start_date' => Carbon::now()->subWeeks(6),
                'hire_end_date' => Carbon::now()->subWeeks(5),
                'active' => 0,
                'created_at' => now()
            ],
            [
                'user_id' => 2,
                'car_id' => 5,
                'hire_start_date' => Carbon::now()->subDays(3),
                'hire_end_date' => Carbon::now()->addWeek(),
                'active' => 1,
                'created_at' => now()
            ],
            [
                'user_id' => 5,
                'car_id' => 3,
                'hire_start_date' => Carbon::now()->subDays(1),
                'hire_end_date' => Carbon::now()->addWeeks(2),
                'active' => 1,
                'created_at' => now()
            ],
        ]);
    }
}
