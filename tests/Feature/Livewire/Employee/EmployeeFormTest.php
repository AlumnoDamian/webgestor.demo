<?php

namespace Tests\Feature\Livewire\Employee;

use Tests\TestCase;
use App\Models\User;
use App\Models\Employee;
use App\Models\Department;
use Livewire\Livewire;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use App\Livewire\Employee\EmployeeForm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Test;
use Spatie\Permission\Models\Role;

class EmployeeFormTest extends TestCase
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

        // Configurar el disco de almacenamiento falso
        Storage::fake('public');
    }

    #[Test]
    public function component_can_render()
    {
        Livewire::test(EmployeeForm::class)
            ->assertViewIs('livewire.employee.employee-form')
            ->assertSeeText(['Departamento', 'Cargo']);
    }

    #[Test]
    public function can_create_employee_with_minimum_required_fields()
    {
        $newEmail = $this->faker->unique()->safeEmail;

        Livewire::test(EmployeeForm::class)
            ->set('name', 'John Doe')
            ->set('email', $newEmail)
            ->set('password', 'password')
            ->set('dni', '12345678A')
            ->set('role', 'empleado')
            ->set('spatie_role', 'empleado')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('employees', [
            'name' => 'John Doe',
            'email' => $newEmail,
            'dni' => '12345678A',
            'role' => 'empleado'
        ]);
    }

    #[Test]
    public function can_create_employee_with_all_fields()
    {
        $newEmail = $this->faker->unique()->safeEmail;

        Livewire::test(EmployeeForm::class)
            ->set('name', 'Jane Smith')
            ->set('email', $newEmail)
            ->set('password', 'password')
            ->set('dni', '87654321B')
            ->set('phone', '123456789')
            ->set('address', 'Test Address 123')
            ->set('hire_date', '2025-01-01')
            ->set('department_id', $this->department->id)
            ->set('role', 'supervisor')
            ->set('spatie_role', 'empleado')
            ->set('birth_date', '1990-01-01')
            ->set('is_active', true)
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('employees', [
            'name' => 'Jane Smith',
            'email' => $newEmail,
            'dni' => '87654321B',
            'phone' => '123456789',
            'address' => 'Test Address 123',
            'department_id' => $this->department->id,
            'role' => 'supervisor',
            'is_active' => true
        ]);
    }

    #[Test]
    public function can_update_existing_employee()
    {
        $user = User::factory()->create();
        $employee = Employee::factory()->create([
            'department_id' => $this->department->id,
            'user_id' => $user->id,
            'dni' => '11111111A'
        ]);

        Livewire::test(EmployeeForm::class, ['employee' => $employee])
            ->assertSet('name', $employee->name)
            ->set('name', 'Updated Name')
            ->set('phone', '987654321')
            ->set('role', 'supervisor')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('employees', [
            'id' => $employee->id,
            'name' => 'Updated Name',
            'phone' => '987654321',
            'role' => 'supervisor'
        ]);
    }

    #[Test]
    public function validates_required_fields()
    {
        Livewire::test(EmployeeForm::class)
            ->set('name', '')
            ->set('dni', '')
            ->set('role', '-')
            ->call('save')
            ->assertHasErrors([
                'name' => 'required',
                'dni' => 'required',
                'role' => 'required'
            ]);
    }

    #[Test]
    public function validates_email_format_and_uniqueness()
    {
        $user = User::factory()->create(['email' => 'existing@example.com']);
        Employee::factory()->create([
            'email' => 'existing@example.com',
            'user_id' => $user->id
        ]);

        Livewire::test(EmployeeForm::class)
            ->set('email', 'invalid-email')
            ->assertHasErrors(['email' => 'email'])
            ->set('email', 'existing@example.com')
            ->assertHasErrors('email');
    }

    #[Test]
    public function validates_dni_format_and_uniqueness()
    {
        $user = User::factory()->create();
        Employee::factory()->create([
            'dni' => '12345678A',
            'user_id' => $user->id
        ]);

        Livewire::test(EmployeeForm::class)
            ->set('dni', '123') // Formato inválido
            ->assertHasErrors(['dni' => 'regex'])
            ->set('dni', '12345678A')
            ->assertHasErrors('dni');
    }

    #[Test]
    public function validates_phone_format()
    {
        Livewire::test(EmployeeForm::class)
            ->set('phone', '123') // Formato inválido
            ->assertHasErrors(['phone' => 'regex'])
            ->set('phone', '123456789') // Formato válido
            ->assertHasNoErrors('phone');
    }

    #[Test]
    public function validates_birth_date()
    {
        Livewire::test(EmployeeForm::class)
            ->set('birth_date', now()->addDay()->format('Y-m-d')) // Fecha futura
            ->assertHasErrors(['birth_date' => 'before'])
            ->set('birth_date', '1990-01-01') // Fecha válida
            ->assertHasNoErrors('birth_date');
    }

    #[Test]
    public function validates_role_values()
    {
        Livewire::test(EmployeeForm::class)
            ->set('role', 'invalid_role')
            ->assertHasErrors('role')
            ->set('role', 'empleado')
            ->assertHasNoErrors('role');
    }

    #[Test]
    public function validates_spatie_role_values()
    {
        Livewire::test(EmployeeForm::class)
            ->set('spatie_role', 'invalid_role')
            ->assertHasErrors(['spatie_role' => 'in'])
            ->set('spatie_role', 'admin')
            ->assertHasNoErrors('spatie_role');
    }

    #[Test]
    public function can_handle_department_assignment()
    {
        $department = Department::factory()->create();

        Livewire::test(EmployeeForm::class)
            ->set('department_id', '-')
            ->assertHasNoErrors('department_id') // Permitido valor especial '-'
            ->set('department_id', 999999) // ID inexistente
            ->assertHasErrors('department_id')
            ->set('department_id', $department->id)
            ->assertHasNoErrors('department_id');
    }

    #[Test]
    public function real_time_validation_works()
    {
        Livewire::test(EmployeeForm::class)
            ->set('name', 'a') // Muy corto
            ->assertHasErrors(['name' => 'min'])
            ->set('name', 'John Doe') // Correcto
            ->assertHasNoErrors('name');
    }

    #[Test]
    public function can_reset_form()
    {
        Livewire::test(EmployeeForm::class)
            ->set('name', 'John Doe')
            ->call('cancel')
            ->assertSet('name', null);
    }

    #[Test]
    public function validates_password_only_for_new_employees()
    {
        // Para nuevo empleado
        Livewire::test(EmployeeForm::class)
            ->set('password', '')
            ->call('save')
            ->assertHasErrors(['password' => 'required']);

        // Para empleado existente
        $user = User::factory()->create();
        $employee = Employee::factory()->create([
            'user_id' => $user->id
        ]);

        Livewire::test(EmployeeForm::class, ['employee' => $employee])
            ->set('password', '')
            ->assertHasNoErrors('password');
    }

    #[Test]
    public function can_remove_employee_image()
    {
        // Crear un empleado con una imagen
        $user = User::factory()->create();
        $imagePath = 'employees/test-image.jpg';
        
        // Crear el archivo en el storage falso
        Storage::disk('public')->put($imagePath, 'test image content');

        $employee = Employee::factory()->create([
            'user_id' => $user->id,
            'image' => $imagePath
        ]);

        // Verificar que la imagen existe antes de eliminarla
        Storage::disk('public')->assertExists($imagePath);

        // Eliminar la imagen
        Livewire::test(EmployeeForm::class, ['employee' => $employee])
            ->call('removeImage');

        // Verificar que el campo image en la base de datos es null
        $this->assertDatabaseHas('employees', [
            'id' => $employee->id,
            'image' => null
        ]);
    }

    #[Test]
    public function removing_image_works_for_new_employee()
    {
        $component = Livewire::test(EmployeeForm::class);

        // Simular una imagen temporal
        $temporaryImage = $this->createMock(TemporaryUploadedFile::class);
        $temporaryImage->method('temporaryUrl')->willReturn('test-image.jpg');
        $temporaryImage->name = 'test-image.jpg';
        $temporaryImage->method('getSize')->willReturn(1024);
        $temporaryImage->method('getMimeType')->willReturn('image/jpeg');

        // Establecer la imagen temporal
        $component->set('image', $temporaryImage);

        // Eliminar la imagen
        $component->call('removeImage')
            ->assertSet('image', null)
            ->assertSet('temporaryImage', null);
    }
}
