<?php

// database/factories/WorkspaceFactory.php

namespace Database\Factories;

use App\Models\Workspace;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkspaceFactory extends Factory
{
    protected $model = Workspace::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'capacity' => $this->faker->numberBetween(5, 20),
            'ownerId' => function () {
                return User::factory()->create()->id;
            },
        ];
    }
}
