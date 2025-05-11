<?php

namespace Tests\Feature\Livewire\Department;

use App\Livewire\Department\DepartmentTable;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DepartmentTableTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_render_department_table()
    {
        Livewire::test(DepartmentTable::class)
            ->assertOk();
    }

    public function test_can_sort_departments()
    {
        $departmentA = Department::factory()->create(['name' => 'AAA Department']);
        $departmentB = Department::factory()->create(['name' => 'BBB Department']);

        $component = Livewire::test(DepartmentTable::class);
        
        // Verificar orden inicial
        $component->assertSet('sortField', 'name')
            ->assertSet('sortDirection', 'asc');

        // Verificar cambio a orden descendente
        $component->call('sortBy', 'name')
            ->assertSet('sortField', 'name')
            ->assertSet('sortDirection', 'desc');

        // Verificar vuelta a orden ascendente
        $component->call('sortBy', 'name')
            ->assertSet('sortField', 'name')
            ->assertSet('sortDirection', 'asc');
    }

    public function test_can_sort_departments_twice()
    {
        $departmentA = Department::factory()->create(['name' => 'AAA Department']);
        $departmentB = Department::factory()->create(['name' => 'BBB Department']);

        $component = Livewire::test(DepartmentTable::class);
        
        // Verificar cambio a orden descendente
        $component->call('sortBy', 'name')
            ->assertSet('sortField', 'name')
            ->assertSet('sortDirection', 'desc');

        // Verificar vuelta a orden ascendente
        $component->call('sortBy', 'name')
            ->assertSet('sortField', 'name')
            ->assertSet('sortDirection', 'asc');

        // Verificar cambio a orden descendente de nuevo
        $component->call('sortBy', 'name')
            ->assertSet('sortField', 'name')
            ->assertSet('sortDirection', 'desc');
    }

    public function test_can_open_form_modal()
    {
        $department = Department::factory()->create();

        Livewire::test(DepartmentTable::class)
            ->call('openFormModal', $department->id)
            ->assertSet('showFormModal', true)
            ->assertSet('editingDepartmentId', $department->id);
    }

    public function test_can_close_form_modal()
    {
        Livewire::test(DepartmentTable::class)
            ->set('showFormModal', true)
            ->set('editingDepartmentId', 1)
            ->call('closeFormModal')
            ->assertSet('showFormModal', false)
            ->assertSet('editingDepartmentId', null);
    }

    public function test_can_confirm_department_deletion()
    {
        $department = Department::factory()->create();

        Livewire::test(DepartmentTable::class)
            ->call('confirmDelete', $department->id)
            ->assertSet('showDeleteModal', true)
            ->assertSet('departmentToDelete.id', $department->id);
    }

    public function test_can_delete_department()
    {
        $department = Department::factory()->create();
        $employee = Employee::factory()->create(['department_id' => $department->id]);

        Livewire::test(DepartmentTable::class)
            ->set('departmentToDelete', $department)
            ->call('deleteDepartment')
            ->assertSet('showDeleteModal', false)
            ->assertSet('departmentToDelete', null);

        $this->assertDatabaseMissing('departments', ['id' => $department->id]);
        $this->assertDatabaseHas('employees', [
            'id' => $employee->id,
            'department_id' => null
        ]);
    }

    public function test_can_close_delete_modal()
    {
        $department = Department::factory()->create();

        Livewire::test(DepartmentTable::class)
            ->set('showDeleteModal', true)
            ->set('departmentToDelete', $department)
            ->call('closeDeleteModal')
            ->assertSet('showDeleteModal', false)
            ->assertSet('departmentToDelete', null);
    }

    public function test_can_paginate_departments()
    {
        Department::factory()->count(15)->create();

        $component = Livewire::test(DepartmentTable::class);
        
        $this->assertEquals(10, $component->get('perPage')); // Verifica que el valor por defecto es 10
        $this->assertCount(10, $component->get('departments')); // Verifica que solo se muestran 10 elementos
    }
}
