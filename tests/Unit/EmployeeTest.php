<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Employee;
use App\Models\Department;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;

class EmployeeTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private Employee $employee;
    private Department $department;
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Preparar datos base para las pruebas
        $this->department = Department::factory()->create();
        $this->user = User::factory()->create();
        $this->employee = Employee::factory()->create([
            'department_id' => $this->department->id,
            'user_id' => $this->user->id
        ]);
    }

    #[Test]
    public function it_can_create_employee_with_minimum_required_fields()
    {
        $employee = Employee::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'user_id' => $this->user->id
        ]);

        $this->assertInstanceOf(Employee::class, $employee);
        $this->assertEquals('John Doe', $employee->name);
        $this->assertEquals('john@example.com', $employee->email);
    }

    #[Test]
    public function it_can_create_employee_with_all_fields()
    {
        $employeeData = [
            'user_id' => $this->user->id,
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'dni' => '12345678A',
            'role' => 'supervisor',
            'birth_date' => '1990-01-01',
            'phone' => '123456789',
            'address' => 'Test Address 123',
            'hire_date' => '2025-01-01',
            'department_id' => $this->department->id,
            'is_active' => true,
            'image' => 'profile.jpg'
        ];

        $employee = Employee::create($employeeData);

        foreach ($employeeData as $key => $value) {
            if (in_array($key, ['birth_date', 'hire_date'])) {
                $this->assertEquals($value, $employee->$key->format('Y-m-d'));
            } else {
                $this->assertEquals($value, $employee->$key);
            }
        }
    }

    #[Test]
    public function it_properly_handles_relationships()
    {
        $this->assertInstanceOf(Department::class, $this->employee->department);
        $this->assertInstanceOf(User::class, $this->employee->user);
        $this->assertEquals($this->department->id, $this->employee->department->id);
        $this->assertEquals($this->user->id, $this->employee->user->id);
    }

    #[Test]
    public function it_can_filter_active_employees()
    {
        Employee::factory()->count(3)->create(['is_active' => true]);
        Employee::factory()->count(2)->create(['is_active' => false]);

        $activeEmployees = Employee::where('is_active', true)->get();
        $inactiveEmployees = Employee::where('is_active', false)->get();

        $this->assertEquals(4, $activeEmployees->count()); // 3 + 1 from setUp
        $this->assertEquals(2, $inactiveEmployees->count());
    }

    #[Test]
    public function it_properly_handles_date_attributes()
    {
        $employee = Employee::factory()->create([
            'birth_date' => '1990-01-01',
            'hire_date' => '2025-01-01'
        ]);

        $this->assertInstanceOf(Carbon::class, $employee->birth_date);
        $this->assertInstanceOf(Carbon::class, $employee->hire_date);
        $this->assertEquals('1990-01-01', $employee->birth_date->format('Y-m-d'));
        $this->assertEquals('2025-01-01', $employee->hire_date->format('Y-m-d'));
    }

    #[Test]
    public function it_validates_unique_email()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Employee::factory()->create([
            'email' => 'duplicate@example.com'
        ]);

        Employee::factory()->create([
            'email' => 'duplicate@example.com'
        ]);
    }

    #[Test]
    public function it_validates_unique_dni()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Employee::factory()->create([
            'dni' => '12345678A'
        ]);

        Employee::factory()->create([
            'dni' => '12345678A'
        ]);
    }

    #[Test]
    public function it_validates_role_enum_values()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Employee::factory()->create([
            'role' => 'invalid_role'
        ]);
    }

    #[Test]
    public function it_can_soft_delete_employee()
    {
        $employee = Employee::factory()->create();
        $employee->delete();

        $this->assertSoftDeleted($employee);
        $this->assertDatabaseHas('employees', ['id' => $employee->id]);
        $this->assertNotNull($employee->deleted_at);
    }

    #[Test]
    public function it_can_restore_soft_deleted_employee()
    {
        $employee = Employee::factory()->create();
        $employee->delete();
        $employee->restore();

        $this->assertNull($employee->fresh()->deleted_at);
        $this->assertDatabaseHas('employees', [
            'id' => $employee->id,
            'deleted_at' => null
        ]);
    }

    #[Test]
    public function it_can_update_employee_information()
    {
        $newDepartment = Department::factory()->create();
        
        $this->employee->update([
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'department_id' => $newDepartment->id
        ]);

        $this->employee->refresh();

        $this->assertEquals('Updated Name', $this->employee->name);
        $this->assertEquals('updated@example.com', $this->employee->email);
        $this->assertEquals($newDepartment->id, $this->employee->department_id);
    }

    #[Test]
    public function it_can_search_employees_by_department()
    {
        $department = Department::factory()->create();
        Employee::factory()->count(3)->create(['department_id' => $department->id]);

        $departmentEmployees = Employee::where('department_id', $department->id)->get();

        $this->assertEquals(3, $departmentEmployees->count());
        $this->assertInstanceOf(Collection::class, $departmentEmployees);
        $departmentEmployees->each(function ($employee) use ($department) {
            $this->assertEquals($department->id, $employee->department_id);
        });
    }
}
