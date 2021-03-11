<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => 'Historias de ultramar',
            'content' => $this->faker->realText($maxNbChars = 3000, $indexSize = 3),
            'category_id' => function () {
                return Category::inRandomOrder()->first()->id;
            },
            'author_id' => function () {
                return User::inRandomOrder()->first()->id;
            },
            'keywords' => 'molas',

            'description' => 'mola',
            'slug' => $this->faker->bothify('##?-##??') ,
            'img_file' => '1612727807.jpg'
        ];
    }
}
