<?php

namespace Database\Factories;

use App\Enums\ScriptStatus;
use App\Models\Script;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Script>
 */
class ScriptFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Script::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'duration' => $this->faker->numberBetween(1, 120),
            'status' => ScriptStatus::DRAFT,
        ];
    }
}
