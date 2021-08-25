<?php

namespace Database\Factories;

use App\Models\EmployeeProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EmployeeProfile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'address' => $this->faker->streetAddress(),
            'phone_number' => $this->faker->phoneNumber(),
            'birthday' => $this->faker->date(),
            'description' => $this->faker->text(50),
            'skills' => $this->faker->text(50),
            'certifications' => $this->faker->text(50),
            'industry' => $this->faker->jobTitle(),
            'cover_photo' => $this->faker->imageUrl(),
            'avatar' => $this->faker->imageUrl(),
            'created_at' => now(),
        ];
    }
}
