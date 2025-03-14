<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Vaciar la tabla de anuncios
        DB::table('announcements')->truncate();

        // Insertar nuevos anuncios con fecha y hora
        DB::table('announcements')->insert([
            [
                'title' => 'Anuncio Evento 1',
                'category' => 'Evento',
                'content' => 'Anuncio sobre un evento importante en la empresa.',
                'priority' => 'Alta',
                'author' => 'Juan Pérez',
                'published_at' => Carbon::now()->subDays(1)->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Anuncio Notificación 1',
                'category' => 'Notificación',
                'content' => 'Notificación sobre una nueva política interna.',
                'priority' => 'Media',
                'author' => 'Ana García',
                'published_at' => Carbon::now()->subDays(2)->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Anuncio General 1',
                'category' => 'General',
                'content' => 'Anuncio general acerca de las nuevas herramientas.',
                'priority' => 'Baja',
                'author' => 'Luis Fernández',
                'published_at' => Carbon::now()->subDays(3)->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Anuncio Evento 2',
                'category' => 'Evento',
                'content' => 'Anuncio sobre la conferencia de tecnología de este mes.',
                'priority' => 'Alta',
                'author' => 'Sofía López',
                'published_at' => Carbon::now()->subDays(5)->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Anuncio Notificación 2',
                'category' => 'Notificación',
                'content' => 'Notificación sobre la actualización del sistema.',
                'priority' => 'Media',
                'author' => 'Carlos Díaz',
                'published_at' => Carbon::now()->subDays(7)->format('Y-m-d H:i:s'),
            ]
        ]);
    }
}
