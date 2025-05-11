<?php

namespace Database\Factories;

use App\Models\Memo;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Memo>
 */
class MemoFactory extends Factory
{
    protected $model = Memo::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraphs(3, true),
            'type' => $this->faker->randomElement(['Importante', 'Informativo', 'Urgente']),
            'department_id' => Department::factory(),
            'published_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
