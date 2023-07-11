<?php

// database/factories/TaskFactory.php

// database/factories/TaskFactory.php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use App\Models\Status;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition()
    {
        return [
            'name' => $this->faker->words(2, true), // Generate a two-word name
            'description' => $this->faker->paragraph,
            'assignee_id' => function () {
                return User::factory()->create()->id;
            },
            'due_date' => $this->faker->dateTimeBetween('+1 week', '+3 weeks'),
            'status_id' => function () {
                return Status::factory()->create()->id;
            },
            'project_id' => function () {
                return Project::factory()->create()->id;
            },
            'priority' => $this->faker->randomElement(['low', 'medium', 'high']),
            'estimated_time' => $this->faker->numberBetween(1, 8),
            'actual_time' => $this->faker->numberBetween(1, 8),
        ];
    }
}
