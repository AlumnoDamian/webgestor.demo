<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\Test;

class DepartmentTest extends TestCase
{
    use RefreshDatabase;

    private Department $department;

    protected function setUp(): void
    {
        parent::setUp();
        $this->department = Department::factory()->create();
    }

    #[Test]
    public function department_has_required_attributes()
    {
        $this->assertNotNull($this->department->code);
        $this->assertNotNull($this->department->name);
        $this->assertNotNull($this->department->status);
    }

    #[Test]
    public function department_can_have_optional_attributes()
    {
        $department = Department::factory()->create([
            'description' => 'Test Description',
            'budget' => 50000.00,
            'phone' => '123456789',
            'email' => 'dept@test.com'
        ]);

        $this->assertEquals('Test Description', $department->description);
        $this->assertEquals(50000.00, $department->budget);
        $this->assertEquals('123456789', $department->phone);
        $this->assertEquals('dept@test.com', $department->email);
    }

    #[Test]
    public function department_can_have_manager()
    {
        $manager = Employee::factory()->create();
        
        $department = Department::factory()->create([
            'manager_id' => $manager->id
        ]);

        $this->assertInstanceOf(Employee::class, $department->manager);
        $this->assertEquals($manager->id, $department->manager->id);
    }

    #[Test]
    public function department_can_have_multiple_employees()
    {
        // Crear empleados asociados al departamento
        $employees = Employee::factory()->count(3)->create([
            'department_id' => $this->department->id
        ]);

        $this->assertEquals(3, $this->department->employees()->count());
        $this->assertInstanceOf(Employee::class, $this->department->employees->first());
    }

    #[Test]
    public function department_can_track_active_employees()
    {
        // Crear empleados activos e inactivos
        Employee::factory()->count(2)->create([
            'department_id' => $this->department->id,
            'is_active' => true
        ]);

        Employee::factory()->create([
            'department_id' => $this->department->id,
            'is_active' => false
        ]);

        $activeEmployees = $this->department->employees()->where('is_active', true)->count();
        $this->assertEquals(2, $activeEmployees);
    }

    #[Test]
    public function department_can_be_inactive()
    {
        $department = Department::factory()->create([
            'status' => false
        ]);

        $this->assertFalse($department->status);
    }

    #[Test]
    public function department_code_is_unique()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        // Intentar crear otro departamento con el mismo código
        Department::factory()->create([
            'code' => $this->department->code
        ]);
    }

    #[Test]
    public function department_can_track_employee_roles()
    {
        // Crear empleados con diferentes roles
        Employee::factory()->count(2)->create([
            'department_id' => $this->department->id,
            'role' => 'empleado'
        ]);

        Employee::factory()->create([
            'department_id' => $this->department->id,
            'role' => 'supervisor'
        ]);

        $roleCount = $this->department->employees()
            ->select('role', DB::raw('count(*) as total'))
            ->groupBy('role')
            ->get()
            ->pluck('total', 'role')
            ->toArray();

        $this->assertEquals(2, $roleCount['empleado']);
        $this->assertEquals(1, $roleCount['supervisor']);
    }

    #[Test]
    public function department_can_be_deleted()
    {
        $departmentId = $this->department->id;
        
        // Crear algunos empleados asociados
        $employees = Employee::factory()->count(2)->create([
            'department_id' => $departmentId
        ]);

        // Eliminar el departamento
        $this->department->delete();

        // Verificar que el departamento fue eliminado
        $this->assertDatabaseMissing('departments', ['id' => $departmentId]);

        // Verificar que los empleados fueron actualizados a null (onDelete set null)
        foreach ($employees as $employee) {
            $this->assertDatabaseHas('employees', [
                'id' => $employee->id,
                'department_id' => null
            ]);
        }
    }

    #[Test]
    public function department_can_filter_employees_by_role()
    {
        // Crear empleados con diferentes roles
        Employee::factory()->create([
            'department_id' => $this->department->id,
            'role' => 'supervisor'
        ]);
        Employee::factory()->count(2)->create([
            'department_id' => $this->department->id,
            'role' => 'empleado'
        ]);
        Employee::factory()->create([
            'department_id' => $this->department->id,
            'role' => 'gerente'
        ]);

        $supervisors = $this->department->employees()->where('role', 'supervisor')->count();
        $employees = $this->department->employees()->where('role', 'empleado')->count();
        $managers = $this->department->employees()->where('role', 'gerente')->count();

        $this->assertEquals(1, $supervisors);
        $this->assertEquals(2, $employees);
        $this->assertEquals(1, $managers);
    }

    #[Test]
    public function department_can_get_recent_employees()
    {
        // Crear empleados con diferentes fechas de contratación
        Employee::factory()->create([
            'department_id' => $this->department->id,
            'hire_date' => now()->subMonths(1)
        ]);
        Employee::factory()->create([
            'department_id' => $this->department->id,
            'hire_date' => now()->subMonths(2)
        ]);
        Employee::factory()->create([
            'department_id' => $this->department->id,
            'hire_date' => now()->subYears(1)
        ]);

        $recentEmployees = $this->department->employees()
            ->where('hire_date', '>=', now()->subMonths(3))
            ->count();

        $this->assertEquals(2, $recentEmployees);
    }

    #[Test]
    public function department_budget_can_be_updated()
    {
        $this->department->update(['budget' => 50000]);
        $this->assertEquals(50000, $this->department->budget);

        $this->department->update(['budget' => 75000]);
        $this->assertEquals(75000, $this->department->budget);
    }

    #[Test]
    public function department_can_track_employee_count_by_age_range()
    {
        Employee::factory()->create([
            'department_id' => $this->department->id,
            'birth_date' => now()->subYears(25)
        ]);
        Employee::factory()->create([
            'department_id' => $this->department->id,
            'birth_date' => now()->subYears(35)
        ]);
        Employee::factory()->create([
            'department_id' => $this->department->id,
            'birth_date' => now()->subYears(45)
        ]);

        $ageRanges = $this->department->employees()
            ->selectRaw('
                CASE 
                    WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) < 30 THEN "20-29"
                    WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) < 40 THEN "30-39"
                    ELSE "40+"
                END as age_range,
                COUNT(*) as count
            ')
            ->groupBy('age_range')
            ->get()
            ->pluck('count', 'age_range')
            ->toArray();

        $this->assertEquals(1, $ageRanges['20-29']);
        $this->assertEquals(1, $ageRanges['30-39']);
        $this->assertEquals(1, $ageRanges['40+']);
    }

    #[Test]
    public function department_email_must_be_valid()
    {
        $validator = Validator::make(
            ['email' => 'invalid-email'],
            ['email' => 'email']
        );

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('email', $validator->errors()->messages());
    }

    #[Test]
    public function department_can_be_found_by_code()
    {
        $department = Department::where('code', $this->department->code)->first();
        $this->assertNotNull($department);
        $this->assertEquals($this->department->id, $department->id);
    }

    #[Test]
    public function department_can_update_manager()
    {
        $oldManager = Employee::factory()->create();
        $newManager = Employee::factory()->create();

        // Asignar manager inicial
        $this->department->update(['manager_id' => $oldManager->id]);
        $this->assertEquals($oldManager->id, $this->department->manager_id);

        // Cambiar a nuevo manager
        $this->department->update(['manager_id' => $newManager->id]);
        $this->assertEquals($newManager->id, $this->department->manager_id);
    }

    #[Test]
    public function department_can_be_created_without_optional_fields()
    {
        $department = Department::factory()->create([
            'description' => null,
            'budget' => null,
            'phone' => null,
            'email' => null,
            'manager_id' => null
        ]);

        $this->assertNull($department->description);
        $this->assertNull($department->budget);
        $this->assertNull($department->phone);
        $this->assertNull($department->email);
        $this->assertNull($department->manager_id);
    }

    #[Test]
    public function department_cannot_have_duplicate_email()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        // Crear un departamento con un email
        $email = 'test@example.com';
        Department::factory()->create(['email' => $email]);

        // Intentar crear otro departamento con el mismo email
        Department::factory()->create(['email' => $email]);
    }
}
