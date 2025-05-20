<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CargoItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'description' => $this->faker->randomElement([
                'Baju Gamis', 'Kurma Ajwa', 'Air Zamzam', 'Kain Ihram', 'Souvenir',
            ]),
            'quantity'    => $this->faker->numberBetween(1, 5),
            'price'       => $this->faker->randomFloat(2, 5, 30),
        ];
    }
}
