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
            'gestionar_todo',
            'ver_perfil',
            'ver_horarios',
            'ver_ficha'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Asignar todos los permisos al rol admin
        $adminRole->givePermissionTo(Permission::all());

        // Asignar permisos limitados al rol empleado
        $empleadoRole->givePermissionTo([
            'ver_perfil',
            'ver_horarios',
            'ver_comunicados',
            'ver_ficha'
        ]);
    }
}
