<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Vaciar la tabla de comunicados
        DB::table('memos')->truncate();

        // Insertar nuevos comunicados
        DB::table('memos')->insert([
            [
                'title' => 'Comunicado Importante 1',
                'type' => 'Importante',
                'content' => 'Este es un comunicado importante. Todos deben leerlo.',
                'recipient' => 'Todos los empleados',
                'published_at' => Carbon::now()->subDays(1),
            ],
            [
                'title' => 'Comunicado Informativo 1',
                'type' => 'Informativo',
                'content' => 'Este es un comunicado informativo acerca de la política de la empresa.',
                'recipient' => 'Empleados del departamento de recursos humanos',
                'published_at' => Carbon::now()->subDays(2),
            ],
            [
                'title' => 'Comunicado Urgente 1',
                'type' => 'Urgente',
                'content' => 'Este es un comunicado urgente. Actuar de inmediato.',
                'recipient' => 'Gerentes y directores',
                'published_at' => Carbon::now()->subDays(3),
            ],
            [
                'title' => 'Comunicado Importante 2',
                'type' => 'Importante',
                'content' => 'Este es otro comunicado importante relacionado con la seguridad.',
                'recipient' => 'Todos los empleados',
                'published_at' => Carbon::now()->subDays(5),
            ],
            [
                'title' => 'Comunicado Informativo 2',
                'type' => 'Informativo',
                'content' => 'Este comunicado es informativo sobre las próximas actividades del mes.',
                'recipient' => 'Departamento de Marketing',
                'published_at' => Carbon::now()->subDays(7),
            ]
        ]);
    }
}
