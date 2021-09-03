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


            DB::table('video')->insert([
                'video' => '293775338.mp4',
                'name' => 'kuldeep',
                'title' => 'title',
                'duration' => 'duration',

            ]);

    }
}
