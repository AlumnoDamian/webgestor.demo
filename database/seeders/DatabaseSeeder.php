<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'damian',
             'email' => 'damian@gmail.com',
             'password' => Hash::make('Password1234')
       ]);
       
        User::factory()->create([
             'name' => 'yowi',
             'email' => 'yowi@gmail.com',
             'password' => Hash::make('Password1234')
       ]);
       
    }
}
