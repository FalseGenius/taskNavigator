<?php


namespace Database\Factories;

use App\Models\Project;
use App\Models\Workspace;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'start_date' => $this->faker->dateTimeBetween('now', '+1 week'),
            'end_date' => $this->faker->dateTimeBetween('+2 weeks', '+4 weeks'),
            'workspace_id' => function () {
                return Workspace::factory()->create()->id;
            },
        ];
    }
}
