<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Lawyer;
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
         Lawyer::factory()->count(10)->create();
        Admin::factory()->create();
    }
}
