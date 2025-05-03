<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Deshabilitar temporalmente las claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Vaciar las tablas
        DB::table('memos')->truncate();

        // Obtener todos los departamentos (IDs)
        $departments = DB::table('departments')->pluck('id')->toArray(); // Obtener un arreglo de IDs de departamentos

        // Insertar nuevos comunicados
        DB::table('memos')->insert([
            [
                'title' => 'Comunicado Importante 1',
                'type' => 'Importante',
                'content' => 'Este es un comunicado importante. Todos deben leerlo.',
                'published_at' => Carbon::now()->subDays(1)->format('Y-m-d H:i:s'),
                'department_id' => $departments[array_rand($departments)], // Asignar un departamento aleatorio
            ],
            [
                'title' => 'Comunicado Informativo 1',
                'type' => 'Informativo',
                'content' => 'Este es un comunicado informativo acerca de la política de la empresa.',
                'published_at' => Carbon::now()->subDays(2)->format('Y-m-d H:i:s'),
                'department_id' => $departments[array_rand($departments)], // Asignar un departamento aleatorio
            ],
            [
                'title' => 'Comunicado Urgente 1',
                'type' => 'Urgente',
                'content' => 'Este es un comunicado urgente. Actuar de inmediato.',
                'published_at' => Carbon::now()->subDays(3)->format('Y-m-d H:i:s'),
                'department_id' => $departments[array_rand($departments)], // Asignar un departamento aleatorio
            ],
            [
                'title' => 'Comunicado Importante 2',
                'type' => 'Importante',
                'content' => 'Este es otro comunicado importante relacionado con la seguridad.',
                'published_at' => Carbon::now()->subDays(5)->format('Y-m-d H:i:s'),
                'department_id' => $departments[array_rand($departments)], // Asignar un departamento aleatorio
            ],
            [
                'title' => 'Comunicado Informativo 2',
                'type' => 'Informativo',
                'content' => 'Este comunicado es informativo sobre las próximas actividades del mes.',
                'published_at' => Carbon::now()->subDays(7)->format('Y-m-d H:i:s'),
                'department_id' => $departments[array_rand($departments)], // Asignar un departamento aleatorio
            ]
        ]);

        // Habilitar las claves foráneas nuevamente
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
