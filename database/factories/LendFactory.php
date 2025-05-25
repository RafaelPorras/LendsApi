<?php

namespace Database\Factories;

use App\Models\Lend;
use Illuminate\Database\Eloquent\Factories\Factory;

class LendFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lend::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1,20),
            'copy_id' => $this->faker->numberBetween(1,20),
            'incident_id' => $this->faker->numberBetween(1,20),
            'lend_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'real_return_date' => $this->faker->optional()->dateTimeBetween('now', '+1 month'),
            'expected_return_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'status' => $this->faker->randomElement(['pending', 'returned', 'overdue','renewed']),
            'notes' => $this->faker->optional()->text(200)
        ];
    }
}
