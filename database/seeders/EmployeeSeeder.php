<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Str;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Deshabilitar temporalmente las claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Eliminar los registros anteriores
        DB::table('employees')->truncate();

        $employees = [
            // Empleados para el departamento 1 (Recepción)
            [
                'user_id' => 1,
                'dni' => '78768414S',
                'name' => 'Damián Madueño Bolaños',
                'email' => 'damian.madueno@gmail.com',
                'password' => 'Password1234', // Usar contraseña en texto plano
                'birth_date' => '1985-07-14',
                'address' => 'Calle Falsa 123, Madrid',
                'phone' => '123-456-789',
                'is_active' => true,
                'role' => 'jefe',
            ],
            [
                'user_id' => 2,
                'dni' => '87654321B',
                'name' => 'María López',
                'email' => 'maria.lopez@gmail.com',
                'password' => 'Password1234', // Usar contraseña en texto plano
                'birth_date' => '1990-01-30',
                'address' => 'Calle Verdadera 456, Barcelona',
                'phone' => '987-654-321',
                'is_active' => true,
                'role' => 'recepcionista',
            ],

            // Empleados para el departamento 2 (Limpieza)
            [
                'user_id' => 3,
                'dni' => '11223344C',
                'name' => 'Carlos García',
                'email' => 'carlos.garcia@gmail.com',
                'password' => 'Password1234', // Usar contraseña en texto plano
                'birth_date' => '1982-03-25',
                'address' => 'Avenida Principal 789, Valencia',
                'phone' => '555-123-456',
                'is_active' => true,
                'role' => 'jefe',
            ],
            [
                'user_id' => 4,
                'dni' => '44556677D',
                'name' => 'Lucía Rodríguez',
                'email' => 'lucia.rodriguez@gmail.com',
                'password' => 'Password1234', // Usar contraseña en texto plano
                'birth_date' => '1995-09-20',
                'address' => 'Calle Larga 123, Sevilla',
                'phone' => '666-777-888',
                'is_active' => true,
                'role' => 'limpiador',
            ],

            // Otros empleados
            [
                'user_id' => 5,
                'dni' => '99887766E',
                'name' => 'David Fernández',
                'email' => 'david.fernandez@gmail.com',
                'password' => 'Password1234', // Usar contraseña en texto plano
                'birth_date' => '1989-12-11',
                'address' => 'Calle Sol 789, Madrid',
                'phone' => '999-888-777',
                'is_active' => true,
                'role' => 'jefe',
            ],
            [
                'user_id' => 6,
                'dni' => '55443322F',
                'name' => 'Pedro Martínez',
                'email' => 'pedro.martinez@gmail.com',
                'password' => 'Password1234', // Usar contraseña en texto plano
                'birth_date' => '1992-02-15',
                'address' => 'Calle Luna 456, Málaga',
                'phone' => '777-666-555',
                'is_active' => true,
                'role' => 'analista',
            ],

            // Empleados adicionales para otros departamentos
            [
                'user_id' => 7,
                'dni' => '22334455G',
                'name' => 'Ana Sánchez',
                'email' => 'ana.sanchez@gmail.com',
                'password' => 'Password1234', // Usar contraseña en texto plano
                'birth_date' => '1987-04-05',
                'address' => 'Calle Estrella 123, Valencia',
                'phone' => '555-444-333',
                'is_active' => true,
                'role' => 'cocinero',
            ],
            [
                'user_id' => 8,
                'dni' => '66778899H',
                'name' => 'José Gómez',
                'email' => 'jose.gomez@gmail.com',
                'password' => 'Password1234', // Usar contraseña en texto plano
                'birth_date' => '1994-06-25',
                'address' => 'Avenida 5 123, Madrid',
                'phone' => '444-333-222',
                'is_active' => true,
                'role' => 'conserje',
            ],
        ];

        foreach ($employees as $employee) {
            // Crear usuario en la tabla 'users' (registro de usuario)
            $user = User::create([
                'name' => $employee['name'],
                'email' => $employee['email'],
                'password' => $employee['password'],  // Guardar la contraseña en texto plano
                'email_verified_at' => now(),
                'remember_token' => Str::random(60),
            ]);

            // Crear el empleado en la tabla 'employees'
            DB::table('employees')->insert([
                'user_id' => $user->id,
                'dni' => $employee['dni'],
                'name' => $employee['name'],
                'email' => $employee['email'],
                'password' => $employee['password'],
                'birth_date' => $employee['birth_date'],
                'address' => $employee['address'],
                'phone' => $employee['phone'],
                'is_active' => $employee['is_active'],
                'role' => $employee['role'],
            ]);
        }

        // Habilitar las claves foráneas nuevamente
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
