<?php

namespace Database\Factories;

use App\Models\ForumSubcategories;
use App\Models\ForumCategories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ForumSubcategoriesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ForumSubcategories::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => ForumCategories::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'subcategory_name' => $this->faker->sentence(rand(5, 15), true),
            'subcategory_first_comment' => $this->faker->text(200),
        ];
    }
}
