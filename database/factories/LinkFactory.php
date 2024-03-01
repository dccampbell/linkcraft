<?php

namespace Database\Factories;

use App\Models\Link;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Link> */
class LinkFactory extends Factory
{
    public function definition(): array
    {
        return [
            'url' => 'https://'.$this->faker->safeEmailDomain().'/'.$this->faker->slug(3),
            'slug' => Link::generateSlug(),
        ];
    }
}
