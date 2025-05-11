<?php

namespace Tests\Feature\Livewire\Employee;

use Tests\TestCase;
use App\Models\User;
use App\Models\Employee;
use App\Models\Department;
use Livewire\Livewire;
use App\Livewire\Employee\EmployeeTable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use PHPUnit\Framework\Attributes\Test;

class EmployeeTableTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private User $admin;
    private Department $department;

    protected function setUp(): void
    {
        parent::setUp();

        // Crear roles necesarios
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'empleado']);

        // Crear usuario admin
        $this->admin = User::factory()->create();
        $this->admin->assignRole('admin');

        // Crear departamento
        $this->department = Department::factory()->create();

        // Autenticar como admin
        $this->actingAs($this->admin);
    }

    #[Test]
    public function component_can_render()
    {
        Livewire::test(EmployeeTable::class)
            ->assertViewIs('livewire.employee.employee-table')
            ->assertSee('Nuevo Empleado');
    }

    #[Test]
    public function can_change_per_page()
    {
        // Crear 15 empleados
        Employee::factory()->count(15)->create();

        $component = Livewire::test(EmployeeTable::class)
            ->assertSet('perPage', 10) // Valor por defecto
            ->set('perPage', 5)
            ->assertSet('perPage', 5);

        // Verificar que solo se muestran 5 empleados
        $this->assertEquals(5, $component->get('employees')->count());
    }

    #[Test]
    public function can_sort_by_column()
    {
        // Crear empleados con nombres específicos
        Employee::factory()->create(['name' => 'Zoe']);
        Employee::factory()->create(['name' => 'Ana']);
        Employee::factory()->create(['name' => 'Bob']);

        $component = Livewire::test(EmployeeTable::class)
            ->assertSet('sortField', 'name')
            ->assertSet('sortDirection', 'asc');

        // Verificar orden ascendente
        $this->assertEquals(
            ['Ana', 'Bob', 'Zoe'],
            $component->get('employees')->pluck('name')->toArray()
        );

        // Cambiar a orden descendente
        $component->call('sortBy', 'name')
            ->assertSet('sortDirection', 'desc');

        // Verificar orden descendente
        $this->assertEquals(
            ['Zoe', 'Bob', 'Ana'],
            $component->get('employees')->pluck('name')->toArray()
        );
    }

    #[Test]
    public function can_filter_active_employees()
    {
        // Crear empleados activos e inactivos
        Employee::factory()->count(3)->create(['is_active' => true]);
        Employee::factory()->count(2)->create(['is_active' => false]);

        $component = Livewire::test(EmployeeTable::class)
            ->assertSet('showOnlyActive', false)
            ->set('showOnlyActive', true);

        // Verificar que solo se muestran empleados activos
        $this->assertEquals(3, $component->get('employees')->total());
    }

    #[Test]
    public function can_open_form_modal()
    {
        Livewire::test(EmployeeTable::class)
            ->assertSet('showFormModal', false)
            ->call('openFormModal')
            ->assertSet('showFormModal', true)
            ->assertSet('editingEmployeeId', null);

        // Probar edición
        $employee = Employee::factory()->create();
        Livewire::test(EmployeeTable::class)
            ->call('openFormModal', $employee->id)
            ->assertSet('showFormModal', true)
            ->assertSet('editingEmployeeId', $employee->id);
    }

    #[Test]
    public function can_delete_employee()
    {
        $user = User::factory()->create();
        $employee = Employee::factory()->create(['user_id' => $user->id]);

        Livewire::test(EmployeeTable::class)
            ->call('confirmDelete', $employee->id)
            ->assertSet('showDeleteModal', true)
            ->assertSet('employeeToDelete.id', $employee->id)
            ->call('deleteEmployee');

        // Verificar que el empleado y su usuario fueron eliminados
        $this->assertDatabaseMissing('employees', ['id' => $employee->id]);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    #[Test]
    public function shows_correct_statistics()
    {
        // Crear empleados con diferentes roles y estados
        Employee::factory()->count(3)->create(['is_active' => true, 'role' => 'empleado']);
        Employee::factory()->count(2)->create(['is_active' => false, 'role' => 'supervisor']);
        Employee::factory()->create(['is_active' => true, 'role' => 'empleado']);

        $component = Livewire::test(EmployeeTable::class);

        // Verificar estadísticas
        $this->assertEquals(4, $component->viewData('totalActive'));
        $this->assertEquals(2, $component->viewData('totalInactive'));
        $this->assertEquals('empleado', $component->viewData('mostCommonRole')->role);
    }

    #[Test]
    public function pagination_works_correctly()
    {
        // Crear 25 empleados
        Employee::factory()->count(25)->create();

        $component = Livewire::test(EmployeeTable::class)
            ->set('perPage', 10);

        // Verificar primera página
        $this->assertEquals(10, $component->get('employees')->count());
        $this->assertEquals(25, $component->get('employees')->total());
        $this->assertEquals(1, $component->get('employees')->currentPage());
    }

    #[Test]
    public function roles_distribution_is_correct()
    {
        // Crear empleados con diferentes roles
        Employee::factory()->count(3)->create(['role' => 'empleado']);
        Employee::factory()->count(2)->create(['role' => 'supervisor']);
        Employee::factory()->create(['role' => 'empleado']);

        $component = Livewire::test(EmployeeTable::class);
        $rolesDistribution = $component->viewData('rolesDistribution');

        // Verificar la distribución de roles
        $this->assertEquals(2, $rolesDistribution->count());
        $this->assertEquals(4, $rolesDistribution->where('role', 'empleado')->first()->count);
        $this->assertEquals(2, $rolesDistribution->where('role', 'supervisor')->first()->count);
    }

    #[Test]
    public function last_updated_shows_correct_employee()
    {
        // Crear empleados con diferentes fechas
        $oldEmployee = Employee::factory()->create(['updated_at' => now()->subDays(2)]);
        $newEmployee = Employee::factory()->create(['updated_at' => now()]);

        $component = Livewire::test(EmployeeTable::class);
        $lastUpdated = $component->viewData('lastUpdated');

        // Verificar que se muestra el empleado más reciente
        $this->assertTrue($lastUpdated->eq($newEmployee->updated_at));
    }

    #[Test]
    public function can_close_modals()
    {
        $component = Livewire::test(EmployeeTable::class)
            ->set('showFormModal', true)
            ->set('showDeleteModal', true)
            ->call('closeFormModal')
            ->assertSet('showFormModal', false)
            ->call('closeDeleteModal')
            ->assertSet('showDeleteModal', false);
    }

    #[Test]
    public function non_admin_cannot_see_new_employee_button()
    {
        // Crear usuario no admin
        $user = User::factory()->create();
        $user->assignRole('empleado');

        $this->actingAs($user);

        // Verificar que el botón no está presente en el HTML renderizado
        $component = Livewire::test(EmployeeTable::class)
            ->assertDontSeeText('Nuevo Empleado');
    }

    #[Test]
    public function delete_employee_handles_errors_gracefully()
    {
        $employee = Employee::factory()->create();
        $component = Livewire::test(EmployeeTable::class);

        // Confirmar eliminación
        $component->call('confirmDelete', $employee->id);
        $this->assertEquals($employee->id, $component->get('employeeToDelete.id'));

        // Simular un error forzando que el empleado ya no exista
        $employee->delete();

        // Intentar eliminar
        $component->call('deleteEmployee');
        $this->assertNull($component->get('employeeToDelete'));
        $this->assertFalse($component->get('showDeleteModal'));
    }
}
