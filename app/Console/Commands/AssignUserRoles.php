<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class AssignUserRoles extends Command
{
    protected $signature = 'users:assign-roles {email : Email del usuario} {role : Rol a asignar (admin/empleado)}';
    protected $description = 'Asigna un rol específico a un usuario por su email';

    public function handle()
    {
        $email = $this->argument('email');
        $roleName = $this->argument('role');

        $user = User::where('email', $email)->first();
        if (!$user) {
            $this->error("Usuario con email {$email} no encontrado.");
            return 1;
        }

        $role = Role::where('name', $roleName)->first();
        if (!$role) {
            $this->error("Rol {$roleName} no encontrado.");
            return 1;
        }

        $user->syncRoles([$role->name]);
        $this->info("Rol {$role->name} asignado correctamente al usuario {$user->email}");

        return 0;
    }
}
