<?php

namespace Database\Factories;

use App\Models\ForumCategories;
use Illuminate\Database\Eloquent\Factories\Factory;

class ForumCategoriesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ForumCategories::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_name' => $this->faker->word,
        ];
    }
}
