<?php

namespace Database\Factories;
use Illuminate\Support\Str;
use App\Models\Permit;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PermitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Permit::class;
    public function definition()
    {
        return [
            'display_name' => fake()->name(),
            'code' => fake()->name(),
        ];
    }
}
