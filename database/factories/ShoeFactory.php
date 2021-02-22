<?php

namespace Database\Factories;

use App\Models\Shoe;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShoeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Shoe::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'name' => $this->faker->company,
            'price' => rand(1200, 5700) / 100,
            'url' => $this->faker->imageUrl
        ];
    }
}
