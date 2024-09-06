<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\CaseType;
use App\Models\Client;
use App\Models\Lawyer;
use App\Models\Supervisor;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
         Supervisor::factory()->count(3)->create();
         Lawyer::factory()->count(3)->create();
         Client::factory()->count(3)->create();
        Admin::factory()->create();
        CaseType::factory()->count(10)->create();
    }
}
