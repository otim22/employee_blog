<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create(['name' => 'admin', 'email' => 'admin@gmail.com']);
        \App\Models\User::factory()->count(5)->create();
    }
}
