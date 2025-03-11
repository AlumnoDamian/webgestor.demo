<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Deshabilitar temporalmente las claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Elimina los registros anteriores
        DB::table('departments')->truncate();

        $departments = [
            [
                'code' => 'REC',
                'name' => 'Recepción',
                'description' => 'Departamento encargado de la atención al cliente y el registro de huéspedes.',
                'manager_id' => 1,
                'budget' => 5000.00,
                'phone' => '123-456-789',
                'email' => 'recepcion@hotel.com',
                'status' => true,
            ],
            [
                'code' => 'LIM',
                'name' => 'Limpieza',
                'description' => 'Departamento responsable de mantener las habitaciones y áreas comunes limpias.',
                'manager_id' => 3,
                'budget' => 2000.00,
                'phone' => '123-456-790',
                'email' => 'limpieza@hotel.com',
                'status' => true,
            ],
            [
                'code' => 'MKT',
                'name' => 'Marketing',
                'description' => 'Departamento encargado de la promoción y publicidad del hotel.',
                'manager_id' => 5,
                'budget' => 3000.00,
                'phone' => '123-456-791',
                'email' => 'marketing@hotel.com',
                'status' => true,
            ],
        ];

        DB::table('departments')->insert($departments);

        // Habilitar las claves foráneas nuevamente
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
