<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $cateogry_name = $this->faker->unique()->words($nb=2,$asText=true);
        $slug = Str::slug($cateogry_name);
        return [
            'name' => $cateogry_name,
            'slug' => $slug
        ];
    }
}
