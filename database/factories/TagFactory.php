<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Tag;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{

    protected $model = Tag::class;

    public function suspended(): Factory
    {

    }


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [

           'name' => $this->faker->name(),

        //    'details' => $this->faker->text(),
        ];
    }
}
