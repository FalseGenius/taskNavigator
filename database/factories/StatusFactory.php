<?php

// database/factories/StatusFactory.php

namespace Database\Factories;

use App\Models\Status;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class StatusFactory extends Factory
{
    protected $model = Status::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'project_id' => Project::factory(),
        ];
    }
}
