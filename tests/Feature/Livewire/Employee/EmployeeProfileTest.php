<?php

namespace Tests\Feature\Livewire\Employee;

use Tests\TestCase;
use App\Models\User;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Memo;
use Livewire\Livewire;
use App\Livewire\Employee\EmployeeProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use PHPUnit\Framework\Attributes\Test;

class EmployeeProfileTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private User $user;
    private Employee $employee;
    private Department $department;

    protected function setUp(): void
    {
        parent::setUp();

        // Crear departamento
        $this->department = Department::factory()->create();

        // Crear usuario y empleado
        $this->user = User::factory()->create();
        $this->employee = Employee::factory()->create([
            'user_id' => $this->user->id,
            'department_id' => $this->department->id,
            'birth_date' => '1990-01-01',
            'role' => 'empleado',
            'created_at' => now()
        ]);

        // Autenticar usuario
        $this->actingAs($this->user);
    }

    #[Test]
    public function component_can_render()
    {
        Livewire::test(EmployeeProfile::class)
            ->assertViewIs('livewire.employee.employee-profile')
            ->assertSee($this->employee->name);
    }

    #[Test]
    public function can_update_profile()
    {
        $newData = [
            'phone' => '123456789',
            'address' => '123 Main St',
            'email' => 'new@example.com'
        ];

        Livewire::test(EmployeeProfile::class)
            ->set('editData', $newData)
            ->call('updateProfile')
            ->assertSet('showEditModal', false)
            ->assertSet('successMessage', '¡Perfil actualizado correctamente!');

        $this->assertDatabaseHas('employees', [
            'id' => $this->employee->id,
            'phone' => $newData['phone'],
            'address' => $newData['address'],
            'email' => $newData['email']
        ]);
    }

    #[Test]
    public function validates_profile_update()
    {
        Livewire::test(EmployeeProfile::class)
            ->set('editData.email', 'invalid-email')
            ->call('updateProfile')
            ->assertHasErrors(['editData.email']);
    }

    #[Test]
    public function loads_memo_stats_correctly()
    {
        // Crear algunos memos para el departamento
        Memo::factory()->count(3)->create([
            'department_id' => $this->department->id,
            'type' => 'Informativo',
            'published_at' => now()
        ]);
        Memo::factory()->count(2)->create([
            'department_id' => $this->department->id,
            'type' => 'Urgente',
            'published_at' => now()
        ]);

        $component = Livewire::test(EmployeeProfile::class);
        $memoStats = $component->get('memoStats');

        $this->assertEquals(5, $memoStats['total']);
        $this->assertArrayHasKey('Informativo', $memoStats['byType']);
        $this->assertArrayHasKey('Urgente', $memoStats['byType']);
        $this->assertEquals(3, $memoStats['byType']['Informativo']);
        $this->assertEquals(2, $memoStats['byType']['Urgente']);
    }

    #[Test]
    public function loads_age_data_correctly()
    {
        // Crear otros empleados en el departamento con diferentes edades
        Employee::factory()->create([
            'department_id' => $this->department->id,
            'birth_date' => '1980-01-01'
        ]);
        Employee::factory()->create([
            'department_id' => $this->department->id,
            'birth_date' => '2000-01-01'
        ]);

        $component = Livewire::test(EmployeeProfile::class);
        $ageData = $component->get('ageData');

        $this->assertEquals(Carbon::parse('1990-01-01')->age, $ageData['employeeAge']);
        $this->assertGreaterThan(0, $ageData['departmentAverage']);
        $this->assertEquals(Carbon::parse('2000-01-01')->age, $ageData['youngestAge']);
        $this->assertEquals(Carbon::parse('1980-01-01')->age, $ageData['oldestAge']);
    }

    #[Test]
    public function loads_role_distribution_correctly()
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

        $component = Livewire::test(EmployeeProfile::class);
        $roleDistribution = $component->get('roleDistribution');

        // El empleado creado en setUp también cuenta
        $this->assertEquals(3, $roleDistribution['empleado']);
        $this->assertEquals(1, $roleDistribution['supervisor']);
    }

    #[Test]
    public function loads_department_employees_correctly()
    {
        // Crear empleados activos e inactivos
        Employee::factory()->count(2)->create([
            'department_id' => $this->department->id,
            'is_active' => true,
            'created_at' => now()->subMonths(4)
        ]);
        Employee::factory()->create([
            'department_id' => $this->department->id,
            'is_active' => false,
            'created_at' => now()->subMonths(4)
        ]);
        Employee::factory()->create([
            'department_id' => $this->department->id,
            'is_active' => true,
            'created_at' => now()->subMonth()
        ]);

        $component = Livewire::test(EmployeeProfile::class);
        $departmentEmployees = $component->get('departmentEmployees');

        // Total incluye el empleado creado en setUp (5 en total)
        $this->assertEquals(5, $departmentEmployees['total']);
        $this->assertEquals(4, $departmentEmployees['active']); // 3 activos nuevos + 1 del setUp
        $this->assertEquals(2, $departmentEmployees['recentJoins']); // 1 reciente + el del setUp
    }

    #[Test]
    public function can_clear_success_message()
    {
        Livewire::test(EmployeeProfile::class)
            ->set('successMessage', 'Test message')
            ->call('clearSuccessMessage')
            ->assertSet('successMessage', '');
    }

    #[Test]
    public function modal_operations_work_correctly()
    {
        $component = Livewire::test(EmployeeProfile::class)
            ->assertSet('showEditModal', false)
            ->call('openEditModal')
            ->assertSet('showEditModal', true)
            ->call('closeEditModal')
            ->assertSet('showEditModal', false);

        // Verificar que los datos se reinicializan al cerrar
        $this->assertEquals(
            $this->employee->phone,
            $component->get('editData.phone')
        );
    }
}
