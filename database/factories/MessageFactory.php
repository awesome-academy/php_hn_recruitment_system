<?php

namespace Database\Factories;

use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'from_id' => $this->faker->randomNumber(),
            'to_id' => $this->faker->randomNumber(),
            'content' => $this->faker->text(),
            'is_read' => $this->faker->randomElement(config('user.message')),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
