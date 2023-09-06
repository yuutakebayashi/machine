<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Machine>
 */
class MachineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name"=>$this->faker->realText(10),
            "maker"=>$this->faker->realText(10),
            "price"=>$this->faker->numberBetween($min=1,$max=999),
            "count"=>$this->faker->numberBetween($min=1,$max=999),
            "comment"=>$this->faker->realText(10),
            "image"=>$this->faker->realText(10),
            "created_at"=> date("Y-m-d H:i:s"),
            "updated_at"=>null,
        ];
    }
}
