<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Memo;

class MemoSeeder extends Seeder
{
    public function run(): void
    {
        $memos = [
            [
                'title' => 'Actualización de Procedimientos IT',
                'type' => 'Informativo',
                'content' => 'Se han actualizado los procedimientos de seguridad informática. Por favor, revisen el nuevo protocolo de contraseñas y acceso remoto.',
                'published_at' => '2025-05-05 09:00:00',
                'department_id' => 2 // IT
            ],
            [
                'title' => 'Revisión de Objetivos Q2',
                'type' => 'Importante',
                'content' => 'Recordatorio: La próxima semana comienzan las reuniones de revisión de objetivos del segundo trimestre. Preparen sus informes de progreso.',
                'published_at' => '2025-05-04 11:30:00',
                'department_id' => 1 // RRHH
            ],
            [
                'title' => 'Mantenimiento Sistemas',
                'type' => 'Urgente',
                'content' => 'Este domingo de 00:00 a 06:00 se realizará el mantenimiento programado de los sistemas. Por favor, guarden su trabajo antes de finalizar el viernes.',
                'published_at' => '2025-05-03 15:45:00',
                'department_id' => 2 // IT
            ],
            [
                'title' => 'Presupuesto Marketing Q3',
                'type' => 'Importante',
                'content' => 'Se requiere la presentación del presupuesto estimado para las campañas del tercer trimestre antes del día 20 de este mes.',
                'published_at' => '2025-05-02 10:15:00',
                'department_id' => 3 // Marketing
            ],
            [
                'title' => 'Cierre Contable Mensual',
                'type' => 'Informativo',
                'content' => 'Recordatorio: El cierre contable del mes anterior debe estar completado en los próximos tres días hábiles.',
                'published_at' => '2025-05-01 14:20:00',
                'department_id' => 4 // Finanzas
            ],
            [
                'title' => 'Nueva Política de Ventas',
                'type' => 'Importante',
                'content' => 'Se ha actualizado la política de comisiones y objetivos de ventas. La nueva estructura entrará en vigor el próximo mes.',
                'published_at' => '2025-05-01 10:00:00',
                'department_id' => 6 // Ventas
            ],
            [
                'title' => 'Auditoría de Calidad',
                'type' => 'Urgente',
                'content' => 'La próxima semana tendremos la auditoría de calidad ISO 9001. Todos los departamentos deben tener su documentación actualizada.',
                'published_at' => '2025-04-30 16:30:00',
                'department_id' => 7 // Calidad
            ],
            [
                'title' => 'Actualización Legal',
                'type' => 'Informativo',
                'content' => 'Nueva normativa de protección de datos. Se requiere que todo el personal complete el curso de actualización antes de fin de mes.',
                'published_at' => '2025-04-30 11:45:00',
                'department_id' => 8 // Legal
            ],
            [
                'title' => 'Proyecto de Innovación',
                'type' => 'Importante',
                'content' => 'Lanzamiento del nuevo proyecto de innovación tecnológica. Se solicitan voluntarios de todos los departamentos para formar el equipo.',
                'published_at' => '2025-04-29 15:20:00',
                'department_id' => 9 // I+D
            ],
            [
                'title' => 'Campaña de Comunicación',
                'type' => 'Informativo',
                'content' => 'Nueva campaña de comunicación interna. Se solicita la colaboración de todos los departamentos para compartir sus historias de éxito.',
                'published_at' => '2025-04-29 09:15:00',
                'department_id' => 10 // Comunicación
            ],
            [
                'title' => 'Evaluación de Desempeño',
                'type' => 'Importante',
                'content' => 'Inicio del período de evaluación semestral. Los supervisores deben programar las reuniones con sus equipos.',
                'published_at' => '2025-04-28 14:30:00',
                'department_id' => 1 // RRHH
            ],
            [
                'title' => 'Actualización de Software',
                'type' => 'Urgente',
                'content' => 'Actualización crítica de seguridad. Todos los equipos deben ser actualizados antes del próximo lunes.',
                'published_at' => '2025-04-28 10:45:00',
                'department_id' => 2 // IT
            ]
        ];

        foreach ($memos as $memo) {
            Memo::create($memo);
        }
    }
}
