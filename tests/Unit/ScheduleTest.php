<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Schedule;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class ScheduleTest extends TestCase
{
    use RefreshDatabase;

    private Schedule $schedule;
    private Employee $employee;

    protected function setUp(): void
    {
        parent::setUp();
        $this->employee = Employee::factory()->create();
        $this->schedule = Schedule::factory()->create([
            'employee_id' => $this->employee->id,
            'day' => now(),
            'shift' => '09:00 - 17:00'
        ]);
    }

    #[Test]
    public function schedule_has_required_attributes()
    {
        $this->assertNotNull($this->schedule->employee_id);
        $this->assertNotNull($this->schedule->day);
        $this->assertNotNull($this->schedule->shift);
    }

    #[Test]
    public function schedule_belongs_to_employee()
    {
        $this->assertInstanceOf(Employee::class, $this->schedule->employee);
        $this->assertEquals($this->employee->id, $this->schedule->employee->id);
    }

    #[Test]
    public function schedule_can_be_created_with_specific_shift()
    {
        $shift = '10:00 - 18:00';
        $schedule = Schedule::factory()->create([
            'employee_id' => $this->employee->id,
            'shift' => $shift
        ]);

        $this->assertEquals($shift, $schedule->shift);
    }

    #[Test]
    public function schedule_can_have_null_shift()
    {
        $schedule = Schedule::factory()->create([
            'employee_id' => $this->employee->id,
            'shift' => null
        ]);

        $this->assertNull($schedule->shift);
    }

    #[Test]
    public function schedule_can_be_filtered_by_date_range()
    {
        // Limpiar horarios existentes
        Schedule::query()->delete();

        $today = now()->startOfDay();
        $tomorrow = now()->addDay()->startOfDay();
        $nextWeek = now()->addWeek()->startOfDay();

        // Crear horarios en diferentes fechas
        Schedule::factory()->create([
            'employee_id' => $this->employee->id,
            'day' => $today
        ]);

        Schedule::factory()->create([
            'employee_id' => $this->employee->id,
            'day' => $tomorrow
        ]);

        Schedule::factory()->create([
            'employee_id' => $this->employee->id,
            'day' => $nextWeek
        ]);

        $nextTwoDaysSchedules = Schedule::whereBetween('day', [
            $today,
            $tomorrow->endOfDay()
        ])->count();

        $this->assertEquals(2, $nextTwoDaysSchedules);
    }

    #[Test]
    public function schedule_can_be_filtered_by_employee()
    {
        // Limpiar horarios existentes
        Schedule::query()->delete();

        // Crear horarios para diferentes empleados
        $employee1 = Employee::factory()->create();
        $employee2 = Employee::factory()->create();

        Schedule::factory()->count(2)->create([
            'employee_id' => $employee1->id
        ]);

        Schedule::factory()->create([
            'employee_id' => $employee2->id
        ]);

        $employee1Schedules = Schedule::where('employee_id', $employee1->id)->count();
        $employee2Schedules = Schedule::where('employee_id', $employee2->id)->count();

        $this->assertEquals(2, $employee1Schedules);
        $this->assertEquals(1, $employee2Schedules);
    }

    #[Test]
    public function schedule_can_be_ordered_by_date()
    {
        // Limpiar horarios existentes
        Schedule::query()->delete();

        $today = now()->startOfDay();
        $tomorrow = now()->addDay()->startOfDay();
        $nextWeek = now()->addWeek()->startOfDay();

        Schedule::factory()->create([
            'employee_id' => $this->employee->id,
            'day' => $tomorrow
        ]);

        $todaySchedule = Schedule::factory()->create([
            'employee_id' => $this->employee->id,
            'day' => $today
        ]);

        $nextWeekSchedule = Schedule::factory()->create([
            'employee_id' => $this->employee->id,
            'day' => $nextWeek
        ]);

        $orderedSchedules = Schedule::orderBy('day', 'asc')->get();

        $this->assertTrue(
            $orderedSchedules->first()->day->isSameDay($today),
            'First schedule should be today'
        );
        $this->assertTrue(
            $orderedSchedules->last()->day->isSameDay($nextWeek),
            'Last schedule should be next week'
        );
    }

    #[Test]
    public function schedule_is_deleted_when_employee_is_deleted()
    {
        // Limpiar horarios existentes
        Schedule::query()->delete();

        $employee = Employee::factory()->create();
        $schedule = Schedule::factory()->create([
            'employee_id' => $employee->id
        ]);

        $scheduleId = $schedule->id;
        $this->assertDatabaseHas('schedules', ['id' => $scheduleId]);

        $employee->delete();
        $this->assertDatabaseMissing('schedules', ['id' => $scheduleId]);
    }

    #[Test]
    public function employee_can_have_multiple_schedules()
    {
        // Limpiar horarios existentes
        Schedule::query()->delete();

        // Crear varios horarios para el mismo empleado
        Schedule::factory()->count(3)->create([
            'employee_id' => $this->employee->id
        ]);

        $schedulesCount = $this->employee->schedules()->count();
        $this->assertEquals(3, $schedulesCount);
    }

    #[Test]
    public function schedule_can_be_updated()
    {
        $newShift = '11:00 - 19:00';
        $newDay = now()->addDays(3)->startOfDay();

        $this->schedule->update([
            'shift' => $newShift,
            'day' => $newDay
        ]);

        $this->schedule->refresh();

        $this->assertEquals($newShift, $this->schedule->shift);
        $this->assertTrue(
            $this->schedule->day->isSameDay($newDay),
            'Schedule day should match the new day'
        );
    }

    #[Test]
    public function schedule_can_get_upcoming_shifts()
    {
        // Limpiar horarios existentes
        Schedule::query()->delete();

        $today = now()->startOfDay();

        // Crear horarios pasados y futuros
        Schedule::factory()->create([
            'employee_id' => $this->employee->id,
            'day' => $today->copy()->subDays(2)
        ]);

        Schedule::factory()->create([
            'employee_id' => $this->employee->id,
            'day' => $today->copy()->addDays(1)
        ]);

        Schedule::factory()->create([
            'employee_id' => $this->employee->id,
            'day' => $today->copy()->addDays(3)
        ]);

        $upcomingSchedules = Schedule::where('day', '>=', $today)->count();
        $this->assertEquals(2, $upcomingSchedules);
    }
}
