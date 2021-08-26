<?php

namespace Database\Factories;

use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Job::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->jobTitle,
            'description' => $this->faker->paragraph,
            'location' => $this->faker->address,
            'contact_email' => $this->faker->companyEmail,
            'job_type' => $this->faker->randomElement(config('user.job_type')),
            'quantity' => $this->faker->randomNumber(),
            'salary' => $this->faker->randomNumber(),
            'requirement' => $this->faker->paragraph,
            'benefit' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(config('user.job_status')),
        ];
    }
}
