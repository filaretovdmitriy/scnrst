<?php

namespace Database\Seeders;

use App\Enums\ScriptStatus;
use App\Models\Script;
use Illuminate\Database\Seeder;

class ScriptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Script::factory()->create([
            'name' => 'test',
            'description' => 'test description',
            'duration' => 10,
            'status' => ScriptStatus::DRAFT,
        ]);
    }
}
