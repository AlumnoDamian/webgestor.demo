<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            [
                'code' => 'RH',
                'name' => 'Recursos Humanos',
                'description' => 'Gestión del personal y desarrollo organizacional',
                'budget' => 150000.00,
                'phone' => '912345678',
                'email' => 'rrhh@webgestor.com',
                'status' => true
            ],
            [
                'code' => 'IT',
                'name' => 'Tecnología de la Información',
                'description' => 'Soporte técnico y desarrollo de software',
                'budget' => 200000.00,
                'phone' => '912345679',
                'email' => 'it@webgestor.com',
                'status' => true
            ],
            [
                'code' => 'MKT',
                'name' => 'Marketing',
                'description' => 'Estrategias de marketing y comunicación',
                'budget' => 180000.00,
                'phone' => '912345680',
                'email' => 'marketing@webgestor.com',
                'status' => true
            ],
            [
                'code' => 'FIN',
                'name' => 'Finanzas',
                'description' => 'Gestión financiera y contabilidad',
                'budget' => 250000.00,
                'phone' => '912345681',
                'email' => 'finanzas@webgestor.com',
                'status' => true
            ],
            [
                'code' => 'OPS',
                'name' => 'Operaciones',
                'description' => 'Gestión de operaciones y logística',
                'budget' => 300000.00,
                'phone' => '912345682',
                'email' => 'operaciones@webgestor.com',
                'status' => true
            ],
            [
                'code' => 'VNT',
                'name' => 'Ventas',
                'description' => 'Gestión comercial y desarrollo de negocio',
                'budget' => 275000.00,
                'phone' => '912345683',
                'email' => 'ventas@webgestor.com',
                'status' => true
            ],
            [
                'code' => 'CAL',
                'name' => 'Calidad',
                'description' => 'Control de calidad y mejora continua',
                'budget' => 120000.00,
                'phone' => '912345684',
                'email' => 'calidad@webgestor.com',
                'status' => true
            ],
            [
                'code' => 'LEG',
                'name' => 'Legal',
                'description' => 'Asesoría legal y cumplimiento normativo',
                'budget' => 160000.00,
                'phone' => '912345685',
                'email' => 'legal@webgestor.com',
                'status' => true
            ],
            [
                'code' => 'INV',
                'name' => 'Investigación y Desarrollo',
                'description' => 'Innovación y desarrollo de nuevos productos',
                'budget' => 350000.00,
                'phone' => '912345686',
                'email' => 'investigacion@webgestor.com',
                'status' => true
            ],
            [
                'code' => 'COM',
                'name' => 'Comunicación',
                'description' => 'Comunicación interna y externa',
                'budget' => 140000.00,
                'phone' => '912345687',
                'email' => 'comunicacion@webgestor.com',
                'status' => true
            ]
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
