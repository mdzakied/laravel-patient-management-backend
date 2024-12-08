<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

use Faker\Generator as Faker;

class PatientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Patient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => null, // Relasikan dengan user
            'name' => $this->faker->name(),
            'date_of_birth' => $this->faker->date(),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'phone_number' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'address' => $this->faker->address(),
            'emergency_contact_name' => $this->faker->name(),
            'emergency_contact_phone' => $this->faker->phoneNumber(),
            'is_active' => $this->faker->boolean(50), // 50% chance to be active
        ];
    }
}
