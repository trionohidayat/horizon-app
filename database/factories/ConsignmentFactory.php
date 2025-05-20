<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ConsignmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'passport_no'        => $this->faker->regexify('[A-Z]{2}[0-9]{7}'),
            'shipping_mode'      => $this->faker->randomElement(['Reguler', 'Laut']),

            'sender_name'        => $this->faker->name,
            'sender_hotel'       => $this->faker->company,
            'sender_city'        => $this->faker->city,
            'sender_country'     => 'Saudi Arabia',
            'sender_phone'       => $this->faker->phoneNumber,

            'receiver_name'      => $this->faker->name,
            'receiver_address'   => $this->faker->streetAddress,
            'receiver_city'      => $this->faker->city,
            'receiver_province'  => $this->faker->state,
            'receiver_postal_code' => $this->faker->postcode,
            'receiver_country'   => 'Indonesia',
            'receiver_contact'   => $this->faker->firstName,
            'receiver_phone'     => $this->faker->phoneNumber,

            'carton_type'        => $this->faker->randomElement(['S', 'M', 'L']),
            'weight'             => $this->faker->randomFloat(2, 3, 25),
            'admin_fee'          => 10.00,
            'total_cost'         => $this->faker->randomFloat(2, 50, 150),
        ];
    }
}
