<?php

namespace Tests\Feature\Livewire\Department;

use App\Livewire\Department\DepartmentForm;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DepartmentFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_render_department_form()
    {
        Livewire::test(DepartmentForm::class)
            ->assertOk();
    }

    public function test_can_create_new_department()
    {
        $manager = Employee::factory()->create();

        Livewire::test(DepartmentForm::class)
            ->set('code', 'DEP001')
            ->set('name', 'Test Department')
            ->set('description', 'Test Description')
            ->set('manager_id', $manager->id)
            ->set('budget', 1000)
            ->set('phone', '123456789')
            ->set('email', 'test@example.com')
            ->set('status', true)
            ->call('save');

        $this->assertDatabaseHas('departments', [
            'code' => 'DEP001',
            'name' => 'Test Department',
            'description' => 'Test Description',
            'manager_id' => $manager->id,
            'budget' => 1000,
            'phone' => '123456789',
            'email' => 'test@example.com',
            'status' => true,
        ]);
    }

    public function test_can_update_existing_department()
    {
        $department = Department::factory()->create();
        $newManager = Employee::factory()->create();

        Livewire::test(DepartmentForm::class, ['department' => $department])
            ->assertSet('isEditing', true)
            ->set('name', 'Updated Department')
            ->set('manager_id', $newManager->id)
            ->call('save');

        $this->assertDatabaseHas('departments', [
            'id' => $department->id,
            'name' => 'Updated Department',
            'manager_id' => $newManager->id,
        ]);
    }

    public function test_validates_required_fields()
    {
        Livewire::test(DepartmentForm::class)
            ->set('code', '')
            ->set('name', '')
            ->call('save')
            ->assertHasErrors(['code', 'name']);
    }

    public function test_validates_unique_code()
    {
        $existingDepartment = Department::factory()->create(['code' => 'DEP001']);

        Livewire::test(DepartmentForm::class)
            ->set('code', 'DEP001')
            ->set('name', 'Test Department')
            ->call('save')
            ->assertHasErrors(['code' => 'unique']);
    }

    public function test_can_update_department_with_same_code()
    {
        $department = Department::factory()->create(['code' => 'DEP001']);

        Livewire::test(DepartmentForm::class, ['department' => $department])
            ->set('code', 'DEP001')
            ->set('name', 'Updated Name')
            ->call('save')
            ->assertHasNoErrors('code');

        $this->assertDatabaseHas('departments', [
            'id' => $department->id,
            'code' => 'DEP001',
            'name' => 'Updated Name',
        ]);
    }

    public function test_validates_email_format()
    {
        Livewire::test(DepartmentForm::class)
            ->set('code', 'DEP001')
            ->set('name', 'Test Department')
            ->set('email', 'invalid-email')
            ->call('save')
            ->assertHasErrors(['email']);
    }

    public function test_validates_budget_is_not_negative()
    {
        Livewire::test(DepartmentForm::class)
            ->set('code', 'DEP001')
            ->set('name', 'Test Department')
            ->set('budget', -100)
            ->call('save')
            ->assertHasErrors(['budget']);
    }

    public function test_validates_manager_exists()
    {
        Livewire::test(DepartmentForm::class)
            ->set('code', 'DEP001')
            ->set('name', 'Test Department')
            ->set('manager_id', 999)
            ->call('save')
            ->assertHasErrors(['manager_id']);
    }

    public function test_can_handle_real_time_validation()
    {
        Livewire::test(DepartmentForm::class)
            ->set('code', 'a') // Código demasiado corto
            ->assertHasNoErrors()
            ->set('name', 'ab') // Nombre demasiado corto
            ->assertHasErrors(['name' => 'min']);
    }
}
