<?php

// database/seeders/WorkspaceSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Workspace;

class WorkspaceSeeder extends Seeder
{
    public function run()
    {
        Workspace::factory()->count(10)->create();
    }
}
