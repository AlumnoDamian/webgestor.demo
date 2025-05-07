<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            DepartmentSeeder::class,    // Primero los departamentos
            EmployeeSeeder::class,      // Luego los empleados (que necesitan departamentos)
            MemoSeeder::class,          // Memos (que necesitan departamentos)
        ]);
       
       
    }
}
