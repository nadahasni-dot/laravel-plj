<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MahasiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'nim' => $this->faker->userName(),
            'angkatan' => $this->faker->year(),
            'jurusan' => $this->faker->company(),
        ];
    }
}
