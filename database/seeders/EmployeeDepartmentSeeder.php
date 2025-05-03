<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Deshabilitar temporalmente las claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Eliminar los registros anteriores
        DB::table('employee_department')->truncate();

        $employeeDepartments = [
            // Empleados en el departamento de Recepción
            [
                'employee_id' => 1,
                'department_id' => 1,
            ],
            [
                'employee_id' => 2,
                'department_id' => 1,
            ],

            // Empleados en el departamento de Limpieza
            [
                'employee_id' => 3,
                'department_id' => 2,
            ],
            [
                'employee_id' => 4,
                'department_id' => 2,
            ],

            // Empleados en el departamento de Marketing
            [
                'employee_id' => 5,
                'department_id' => 3,
            ],
            [
                'employee_id' => 6,
                'department_id' => 3,
            ],

            // Empleados adicionales en otros departamentos
            [
                'employee_id' => 7,
                'department_id' => 1,
            ],
            [
                'employee_id' => 8,
                'department_id' => 2,
            ],
        ];

        DB::table('employee_department')->insert($employeeDepartments);

        // Habilitar las claves foráneas nuevamente
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
