<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;
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
        // Primero creamos los jefes de departamento
        $jefes = [
            [
                'name' => 'Antonio Ramirez Garcia',
                'email' => 'antonio.ramirez@webgestor.com',
                'dni' => $this->generateDNI(),
                'role' => 'jefe',
                'birth_date' => '1975-03-15',
                'phone' => $this->generatePhone(),
                'address' => $this->generateAddress(),
                'hire_date' => '2019-01-01',
                'department_id' => 1,
                'is_active' => true,
                'password' => 'Password123!'
            ],
            [
                'name' => 'Beatriz Sanchez Lopez',
                'email' => 'beatriz.sanchez@webgestor.com',
                'dni' => $this->generateDNI(),
                'role' => 'jefe',
                'birth_date' => '1978-06-22',
                'phone' => $this->generatePhone(),
                'address' => $this->generateAddress(),
                'hire_date' => '2019-02-01',
                'department_id' => 2,
                'is_active' => true,
                'password' => 'Password123!'
            ],
            [
                'name' => 'Carlos Martinez Ruiz',
                'email' => 'carlos.martinez@webgestor.com',
                'dni' => $this->generateDNI(),
                'role' => 'jefe',
                'birth_date' => '1976-09-10',
                'phone' => $this->generatePhone(),
                'address' => $this->generateAddress(),
                'hire_date' => '2019-03-01',
                'department_id' => 3,
                'is_active' => true,
                'password' => 'Password123!'
            ],
            [
                'name' => 'Diana Lopez Torres',
                'email' => 'diana.lopez@webgestor.com',
                'dni' => $this->generateDNI(),
                'role' => 'jefe',
                'birth_date' => '1977-12-05',
                'phone' => $this->generatePhone(),
                'address' => $this->generateAddress(),
                'hire_date' => '2019-04-01',
                'department_id' => 4,
                'is_active' => true,
                'password' => 'Password123!'
            ],
            [
                'name' => 'Eduardo Fernandez Ruiz',
                'email' => 'eduardo.fernandez@webgestor.com',
                'dni' => $this->generateDNI(),
                'role' => 'jefe',
                'birth_date' => '1974-08-20',
                'phone' => $this->generatePhone(),
                'address' => $this->generateAddress(),
                'hire_date' => '2019-05-01',
                'department_id' => 5,
                'is_active' => true,
                'password' => 'Password123!'
            ],
            [
                'name' => 'Fernando Ruiz Silva',
                'dni' => $this->generateDNI(),
                'role' => 'jefe',
                'birth_date' => '1976-07-25',
                'phone' => $this->generatePhone(),
                'address' => $this->generateAddress(),
                'hire_date' => '2019-06-01',
                'department_id' => 6,
                'is_active' => true,
                'password' => 'Password123!'
            ],
            [
                'name' => 'Gloria Moreno Castro',
                'dni' => $this->generateDNI(),
                'role' => 'jefe',
                'birth_date' => '1978-11-30',
                'phone' => $this->generatePhone(),
                'address' => $this->generateAddress(),
                'hire_date' => '2019-07-01',
                'department_id' => 7,
                'is_active' => true,
                'password' => 'Password123!'
            ],
            [
                'name' => 'Hugo Torres Vega',
                'dni' => $this->generateDNI(),
                'role' => 'jefe',
                'birth_date' => '1977-02-14',
                'phone' => $this->generatePhone(),
                'address' => $this->generateAddress(),
                'hire_date' => '2019-08-01',
                'department_id' => 8,
                'is_active' => true,
                'password' => 'Password123!'
            ],
            [
                'name' => 'Isabel Diaz Ortiz',
                'dni' => $this->generateDNI(),
                'role' => 'jefe',
                'birth_date' => '1979-05-20',
                'phone' => $this->generatePhone(),
                'address' => $this->generateAddress(),
                'hire_date' => '2019-09-01',
                'department_id' => 9,
                'is_active' => true,
                'password' => 'Password123!'
            ],
            [
                'name' => 'Javier Castro Lopez',
                'dni' => $this->generateDNI(),
                'role' => 'jefe',
                'birth_date' => '1976-08-08',
                'phone' => $this->generatePhone(),
                'address' => $this->generateAddress(),
                'hire_date' => '2019-10-01',
                'department_id' => 10,
                'is_active' => true,
                'password' => 'Password123!'
            ]
        ];

        foreach ($jefes as $jefe) {
            if (isset($jefe['email'])) {
                $email = $jefe['email'];
            } else {
                $name = $jefe['name'];
                $email = $this->generateEmail($name);
            }
            
            $user = User::create([
                'name' => $jefe['name'],
                'email' => $email,
                'password' => Hash::make($jefe['password'])
            ]);

            Employee::create([
                'user_id' => $user->id,
                'name' => $jefe['name'],
                'email' => $email,
                'dni' => $jefe['dni'],
                'role' => $jefe['role'],
                'birth_date' => $jefe['birth_date'],
                'phone' => $jefe['phone'],
                'address' => $jefe['address'],
                'hire_date' => $jefe['hire_date'],
                'department_id' => $jefe['department_id'],
                'is_active' => $jefe['is_active']
            ]);

            // Actualizar el departamento con el ID del jefe
            Department::where('id', $jefe['department_id'])
                     ->update(['manager_id' => Employee::where('user_id', $user->id)->first()->id]);
        }

        // Ahora creamos empleados para cada departamento
        $roles = ['empleado', 'supervisor', 'auxiliar', 'gerente', 'recepcionista', 'cocinero', 'camarero', 'conserje', 'limpiador', 'guardia de seguridad', 'auxiliar administrativo', 'analista'];
        
        // Nombres únicos españoles
        $nombres = [
            'Adrian', 'Bruno', 'Cesar', 'Daniel', 'Ernesto', 'Fernando', 'Gabriel', 'Hugo', 'Ivan', 'Jorge',
            'Kevin', 'Lorenzo', 'Mario', 'Nicolas', 'Oscar', 'Pablo', 'Rafael', 'Samuel', 'Tomas', 'Victor',
            'Alba', 'Blanca', 'Carla', 'Daniela', 'Elena', 'Flora', 'Gema', 'Helena', 'Irene', 'Julia',
            'Karina', 'Laura', 'Marina', 'Nuria', 'Olga', 'Patricia', 'Rosa', 'Sara', 'Teresa', 'Valeria'
        ];

        // Primer apellido único español
        $apellidos1 = [
            'Alonso', 'Blanco', 'Castro', 'Duran', 'Esteban', 'Ferrer', 'Gallego', 'Herrera', 'Iglesias', 'Jimenez',
            'Leon', 'Medina', 'Navarro', 'Ortega', 'Pascual', 'Quintana', 'Ramos', 'Santos', 'Torres', 'Vargas',
            'Aguilar', 'Benitez', 'Campos', 'Delgado', 'Espinosa', 'Flores', 'Garrido', 'Hidalgo', 'Ibañez', 'Lara',
            'Marquez', 'Nieto', 'Ortiz', 'Parra', 'Quesada', 'Rojas', 'Sanz', 'Toro', 'Vega', 'Zamora'
        ];

        // Segundo apellido único español
        $apellidos2 = [
            'Acosta', 'Borrego', 'Crespo', 'Diez', 'Estrada', 'Franco', 'Guerra', 'Hurtado', 'Ibarra', 'Jaen',
            'Luna', 'Mora', 'Navas', 'Ochoa', 'Pardo', 'Quiros', 'Reina', 'Salas', 'Trujillo', 'Urbano',
            'Aranda', 'Bernal', 'Cortes', 'Dominguez', 'Exposito', 'Fuentes', 'Guillen', 'Heredia', 'Iriarte', 'Jurado',
            'Luque', 'Mesa', 'Naranjo', 'Osuna', 'Prieto', 'Romero', 'Suarez', 'Toledo', 'Uribe', 'Velasco'
        ];

        // Mezclar los arrays para obtener nombres aleatorios
        shuffle($nombres);
        shuffle($apellidos1);
        shuffle($apellidos2);

        $usedNames = []; // Array para trackear nombres usados
        $employeeCount = 0;

        for ($i = 1; $i <= 5; $i++) { // Para cada departamento
            for ($j = 0; $j < 10 && $employeeCount < count($nombres); $j++) { // Creamos 10 empleados por departamento
                // Generar nombre único combinando arrays mezclados
                $nombre = $nombres[$employeeCount];
                $apellido1 = $apellidos1[$employeeCount];
                $apellido2 = $apellidos2[$employeeCount];
                
                $name = "$nombre $apellido1 $apellido2";
                $email = $this->generateEmail($name);

                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'password' => Hash::make('Password123!')
                ]);

                Employee::create([
                    'user_id' => $user->id,
                    'name' => $name,
                    'email' => $email,
                    'dni' => $this->generateDNI(),
                    'role' => $roles[array_rand($roles)],
                    'birth_date' => Faker::create()->dateTimeBetween('-60 years', '-20 years')->format('Y-m-d'),
                    'phone' => $this->generatePhone(),
                    'address' => $this->generateAddress(),
                    'hire_date' => Faker::create()->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
                    'department_id' => $i,
                    'is_active' => Faker::create()->boolean(90)
                ]);

                $employeeCount++;
            }
        }
    }
}
