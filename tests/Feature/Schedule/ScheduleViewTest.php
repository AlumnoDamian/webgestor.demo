<?php

namespace Tests\Feature\Schedule;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ScheduleViewTest extends TestCase
{
    use RefreshDatabase;

    private $department;
    private $employees;
    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Crear y autenticar un usuario
        $this->user = User::factory()->create();
        
        $this->department = Department::factory()->create();
        $this->employees = Employee::factory()
            ->count(3)
            ->create(['department_id' => $this->department->id]);
    }

    public function test_schedule_index_shows_department_selector()
    {
        $response = $this->actingAs($this->user)
            ->get(route('cuadrante.show'));

        $response->assertStatus(200)
            ->assertViewHas('departments', function ($departments) {
                return $departments->contains($this->department);
            });
    }

    public function test_schedule_shows_empty_state_without_department()
    {
        $response = $this->actingAs($this->user)
            ->get(route('cuadrante.show'));

        $response->assertStatus(200)
            ->assertViewHas('employees', function ($employees) {
                return $employees->isEmpty();
            });
    }

    public function test_schedule_shows_four_week_tabs()
    {
        $response = $this->actingAs($this->user)
            ->get(route('cuadrante.show', ['department_id' => $this->department->id]));

        $response->assertStatus(200)
            ->assertViewHas('dates', function ($dates) {
                return count($dates) === 4;
            });
    }

    public function test_schedule_shows_correct_shift_options()
    {
        $employee = $this->employees->first();
        $date = Carbon::now()->startOfWeek()->format('Y-m-d');

        Schedule::create([
            'employee_id' => $employee->id,
            'day' => $date,
            'shift' => 'M'
        ]);

        $response = $this->actingAs($this->user)
            ->get(route('cuadrante.show', ['department_id' => $this->department->id]));

        $response->assertStatus(200)
            ->assertViewHas('schedules');
    }

    public function test_schedule_shows_employee_names()
    {
        $response = $this->actingAs($this->user)
            ->get(route('cuadrante.show', ['department_id' => $this->department->id]));

        foreach ($this->employees as $employee) {
            $response->assertSee($employee->name, false);
        }
    }

    public function test_schedule_shows_correct_date_format()
    {
        $response = $this->actingAs($this->user)
            ->get(route('cuadrante.show', ['department_id' => $this->department->id]));
        
        $response->assertStatus(200)
            ->assertViewHas('dates', function ($dates) {
                return !empty($dates[0]) && count($dates[0]) === 7;
            });
    }

    public function test_schedule_shows_legend_modal()
    {
        $response = $this->actingAs($this->user)
            ->get(route('cuadrante.show', ['department_id' => $this->department->id]));

        $response->assertSee('Leyenda', false);
    }

    public function test_schedule_shows_weekend_selector()
    {
        $response = $this->actingAs($this->user)
            ->get(route('cuadrante.show', ['department_id' => $this->department->id]));

        $response->assertSee('Semana', false);
    }

    public function test_schedule_shows_existing_shifts()
    {
        $employee = $this->employees->first();
        $date = Carbon::now()->startOfWeek()->format('Y-m-d');
        
        Schedule::create([
            'employee_id' => $employee->id,
            'day' => $date,
            'shift' => 'M'
        ]);

        $response = $this->actingAs($this->user)
            ->get(route('cuadrante.show', ['department_id' => $this->department->id]));

        $response->assertViewHas('schedules', function ($schedules) {
            return $schedules->count() > 0;
        });
    }

    public function test_schedule_header_shows_department_name()
    {
        $response = $this->actingAs($this->user)
            ->get(route('cuadrante.show', ['department_id' => $this->department->id]));

        $response->assertSee($this->department->name, false);
    }

    public function test_schedule_shows_save_button()
    {
        $response = $this->actingAs($this->user)
            ->get(route('cuadrante.show', ['department_id' => $this->department->id]));

        $response->assertSee('Guardar', false);
    }

    public function test_schedule_requires_authentication()
    {
        $response = $this->get(route('cuadrante.show'));
        $response->assertRedirect(route('login'));
    }
}
