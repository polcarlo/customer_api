<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'username' => $this->faker->userName,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'country' => 'Philippines',
            'city' => $this->faker->city,
            'phone' => $this->faker->phoneNumber,
            'password' => md5('secret'),
        ];
    }
}
