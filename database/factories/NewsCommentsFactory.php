<?php

namespace Database\Factories;

use App\Models\NewsComments;
use App\Models\News;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsCommentsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = NewsComments::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'parent_news_id' => News::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'comment' => $this->faker->text(100),
        ];
    }
}
