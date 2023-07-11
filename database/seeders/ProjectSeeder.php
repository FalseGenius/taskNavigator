<?php

// database/seeders/ProjectSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        Project::factory()->count(50)->create();
    }
}
