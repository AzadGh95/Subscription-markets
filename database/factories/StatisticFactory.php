<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\SubscriptionStatusEnum;
use App\Models\Statistic;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Statistic>
 */
final class StatisticFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Statistic::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'devapp_id' => \App\Models\Devapp::factory(),
            'last_status' => $this->faker->randomElement(
                [SubscriptionStatusEnum::ACCEPT, SubscriptionStatusEnum::PENDING, SubscriptionStatusEnum::REJECT]
            ),
            'expired_count' => $this->faker->numberBetween(0, 1000),
        ];
    }
}
