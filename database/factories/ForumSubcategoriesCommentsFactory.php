<?php

namespace Database\Factories;

use App\Models\ForumSubcategoriesComments;
use App\Models\ForumSubcategories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ForumSubcategoriesCommentsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ForumSubcategoriesComments::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'subcategory_id' => ForumSubcategories::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'comment' => $this->faker->text(200),
        ];
    }
}
