<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        // Deshabilitar temporalmente las claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Limpiar las tablas
        DB::table('employees')->truncate();
        DB::table('users')->truncate();

        $employees = [
            [
                'name' => 'Damián Madueño Bolaños',
                'email' => 'damian.madueno@gmail.com',
                'password' => 'Password1234@',
                'dni' => '78768414S',
                'phone' => '634567890',
                'address' => 'Calle Falsa 123, Madrid',
                'department_id' => 1, // Recepción
                'role' => 'jefe',
                'birth_date' => '1985-07-14',
                'is_active' => true,
            ],
            [
                'name' => 'Ana García López',
                'email' => 'ana.garcia@gmail.com',
                'password' => 'Password1234@',
                'dni' => '23456789B',
                'phone' => '678901234',
                'address' => 'Avenida Principal 45, Barcelona',
                'department_id' => 2, // Limpieza
                'role' => 'supervisor',
                'birth_date' => '1990-03-25',
                'is_active' => true,
            ],
            [
                'name' => 'Carlos Martínez Ruiz',
                'email' => 'carlos.martinez@gmail.com',
                'password' => 'Password1234@',
                'dni' => '34567890C',
                'phone' => '654321098',
                'address' => 'Plaza Mayor 7, Valencia',
                'department_id' => 3, // Marketing
                'role' => 'empleado',
                'birth_date' => '1988-11-30',
                'is_active' => true,
            ]
        ];

        foreach ($employees as $employee) {
            // Crear usuario en la tabla 'users' (registro de usuario)
            $user = User::create([
                'name' => $employee['name'],
                'email' => $employee['email'],
                'password' => Hash::make($employee['password']),
                'email_verified_at' => now(),
                'remember_token' => Str::random(60),
            ]);

            // Generar una fecha de ingreso aleatoria entre 5 años atrás y hoy
            $hire_date = Carbon::now()->subDays(rand(1, 5 * 365));

            // Crear el empleado en la tabla 'employees'
            DB::table('employees')->insert([
                'user_id' => $user->id,
                'dni' => $employee['dni'],
                'name' => $employee['name'],
                'email' => $employee['email'],
                'birth_date' => $employee['birth_date'],
                'address' => $employee['address'],
                'phone' => $employee['phone'],
                'is_active' => $employee['is_active'],
                'role' => $employee['role'],
                'department_id' => $employee['department_id'],
                'hire_date' => $hire_date,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Habilitar las claves foráneas nuevamente
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
