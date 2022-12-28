<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Devapp;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Devapp>
 */
final class DevappFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Devapp::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'platform' => $this->faker->word,
        ];
    }
}
