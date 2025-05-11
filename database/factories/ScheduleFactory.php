<?php

namespace Database\Factories;

use App\Models\Schedule;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    protected $model = Schedule::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $shifts = [
            '09:00 - 17:00',
            '08:00 - 16:00',
            '10:00 - 18:00',
            '14:00 - 22:00',
            '22:00 - 06:00'
        ];

        return [
            'employee_id' => Employee::factory(),
            'day' => $this->faker->dateTimeBetween('now', '+2 weeks'),
            'shift' => $this->faker->randomElement($shifts),
        ];
    }
}
