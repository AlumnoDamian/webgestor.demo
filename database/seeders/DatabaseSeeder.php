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
            RoleAndPermissionSeeder::class,  // Primero los roles y permisos
            DepartmentSeeder::class,         // Luego los departamentos
            EmployeeSeeder::class,           // Luego los empleados (que necesitan departamentos)
            MemoSeeder::class,               // Memos (que necesitan departamentos)
        ]);
    }
}
