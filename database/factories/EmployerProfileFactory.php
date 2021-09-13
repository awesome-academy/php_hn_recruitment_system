<?php

namespace Database\Factories;

use App\Models\EmployerProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployerProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EmployerProfile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'website' => $this->faker->url(),
            'industry' => $this->faker->jobTitle(),
            'company_size' => $this->faker->randomNumber(),
            'description' => $this->faker->text(50),
            'cover_photo' => $this->faker->imageUrl(),
            'logo' => $this->faker->imageUrl(),
            'phone_number' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
