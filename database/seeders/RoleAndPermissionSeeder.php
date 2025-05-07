<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Crear roles
        $adminRole = Role::create(['name' => 'admin']);
        $empleadoRole = Role::create(['name' => 'empleado']);

        // Crear permisos
        $permissions = [
            'ver_cuadrante',
            'ver_botones_tabla',
            'ver_comunicados',
            'gestionar_todo'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Asignar todos los permisos al rol admin
        $adminRole->givePermissionTo(Permission::all());

        // Asignar permisos limitados al rol empleado
        // El empleado no tendrá acceso a 'ver_cuadrante', 'ver_botones_tabla', ni 'ver_comunicados'
        // No asignamos ningún permiso específico al empleado por ahora
    }
}
