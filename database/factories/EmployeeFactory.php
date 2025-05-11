<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'dni' => $this->faker->unique()->numerify('########') . $this->faker->randomLetter,
            'role' => $this->faker->randomElement(['jefe', 'empleado', 'supervisor', 'auxiliar', 'gerente']),
            'birth_date' => $this->faker->date(),
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'hire_date' => $this->faker->date(),
            'department_id' => Department::factory(),
            'is_active' => true,
            'image' => null,
            'email_verified_at' => now(),
            'remember_token' => null
        ];
    }
}
