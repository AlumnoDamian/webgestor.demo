<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Faker\Factory as Faker;

class EmployeeSeeder extends Seeder
{
    private function generateDNI(): string
    {
        $numero = str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
        $letras = "TRWAGMYFPDXBNJZSQVHLCKE";
        $letra = $letras[intval($numero) % 23];
        return $numero . $letra;
    }

    private function generatePhone(): string
    {
        $prefijos = ['6', '7', '9'];
        $prefijo = $prefijos[array_rand($prefijos)];
        return $prefijo . str_pad(rand(10000000, 99999999), 8, '0', STR_PAD_LEFT);
    }

    private function generateAddress(): string
    {
        $tiposVia = ['Calle', 'Avenida', 'Plaza', 'Paseo', 'Ronda', 'Travesia', 'Camino'];
        $nombres = [
            'Mayor', 'Real', 'San Francisco', 'Gran Via', 'Alcala', 'del Sol', 'de la Luna', 
            'del Mar', 'de las Flores', 'del Prado', 'de la Constitucion', 'del Pilar',
            'Santa Maria', 'San Juan', 'del Carmen', 'Nueva', 'Vieja', 'de la Iglesia'
        ];
        $ciudades = [
            'Madrid' => ['28001', '28002', '28003', '28004', '28005'],
            'Barcelona' => ['08001', '08002', '08003', '08004', '08005'],
            'Valencia' => ['46001', '46002', '46003', '46004', '46005'],
            'Sevilla' => ['41001', '41002', '41003', '41004', '41005'],
            'Bilbao' => ['48001', '48002', '48003', '48004', '48005'],
            'Malaga' => ['29001', '29002', '29003', '29004', '29005'],
            'Zaragoza' => ['50001', '50002', '50003', '50004', '50005']
        ];

        $tipoVia = $tiposVia[array_rand($tiposVia)];
        $nombreVia = $nombres[array_rand($nombres)];
        $numero = rand(1, 150);
        $piso = rand(1, 8);
        $letra = chr(rand(65, 70)); // A-F
        $ciudad = array_rand($ciudades);
        $cp = $ciudades[$ciudad][array_rand($ciudades[$ciudad])];

        return "$tipoVia $nombreVia, $numero, ${piso}º$letra, $cp $ciudad";
    }

    private function generateEmail($name): string
    {
        // Convertir a minúsculas y quitar acentos
        $name = strtolower($name);
        $name = str_replace(['á','é','í','ó','ú','ñ','ü'], ['a','e','i','o','u','n','u'], $name);
        
        // Separar nombre y apellidos
        $parts = explode(' ', $name);
        
        // Tomar el primer nombre y el primer apellido
        $firstName = $parts[0];
        $lastName = $parts[1] ?? '';
        
        // Añadir número aleatorio para evitar duplicados
        $randomNum = rand(100, 999);
        
        // Generar el email
        $email = $firstName . '.' . $lastName . $randomNum . '@webgestor.com';
        
        return $email;
    }

    public function run(): void
    {
        $employees = [
            [
                'name' => 'Juan Pérez',
                'email' => 'juan@webgestor.com',
                'dni' => '12345678A',
                'role' => 'jefe',
                'birth_date' => '1990-05-15',
                'phone' => '612345678',
                'address' => 'Calle Mayor 1, Madrid',
                'hire_date' => '2020-01-10',
                'spatie_role' => 'admin'
            ],
            [
                'name' => 'María García',
                'email' => 'maria@webgestor.com',
                'dni' => '87654321B',
                'role' => 'supervisor',
                'birth_date' => '1988-09-20',
                'phone' => '623456789',
                'address' => 'Avenida Principal 23, Barcelona',
                'hire_date' => '2019-11-15',
                'spatie_role' => 'empleado'
            ],
            [
                'name' => 'Carlos Rodríguez',
                'email' => 'carlos@webgestor.com',
                'dni' => '23456789C',
                'role' => 'gerente',
                'birth_date' => '1992-03-10',
                'phone' => '634567890',
                'address' => 'Plaza España 5, Valencia',
                'hire_date' => '2021-02-01',
                'spatie_role' => 'admin'
            ],
            [
                'name' => 'Ana Martínez',
                'email' => 'ana@webgestor.com',
                'dni' => '34567890D',
                'role' => 'recepcionista',
                'birth_date' => '1995-11-25',
                'phone' => '645678901',
                'address' => 'Calle Real 45, Sevilla',
                'hire_date' => '2022-06-20',
                'spatie_role' => 'empleado'
            ],
            [
                'name' => 'David López',
                'email' => 'david@webgestor.com',
                'dni' => '45678901E',
                'role' => 'auxiliar administrativo',
                'birth_date' => '1987-07-30',
                'phone' => '656789012',
                'address' => 'Avenida Libertad 12, Málaga',
                'hire_date' => '2018-09-05',
                'spatie_role' => 'empleado'
            ]
        ];

        foreach ($employees as $employeeData) {
            // Crear usuario
            $user = User::create([
                'name' => $employeeData['name'],
                'email' => $employeeData['email'],
                'password' => Hash::make('Password123!')
            ]);

            // Asignar rol de Spatie
            $user->assignRole($employeeData['spatie_role']);

            // Asignar user_id
            $employeeData['user_id'] = $user->id;

            // Eliminar el campo spatie_role ya que no es parte de la tabla employees
            unset($employeeData['spatie_role']);

            // Crear empleado con todos los campos de la tabla
            Employee::create($employeeData);
        }
    }
}
