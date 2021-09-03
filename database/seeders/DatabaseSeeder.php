<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $faker = Faker::create();

        foreach (range(1,200) as $index) {
            DB::table('video')->insert([
                'video' => $faker->video,
                'name' => $faker->name,
                'title' => $faker->title,
                'duration' => $faker->duration,
              
            ]);
        }
    }
}
