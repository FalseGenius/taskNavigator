<?php

// database/seeders/StatusSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    public function run()
    {
        Status::factory()->count(5)->create();
    }
}
