<?php

namespace Database\Factories;

use App\Models\TypeItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TypeItem>
 */
class TypeItemFactory extends Factory
{
    private static $code = 1;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->name(),
            'code' => str_pad(
                self::$code++,
                3,
                '0',
                STR_PAD_LEFT
            ),
        ];
    }
}
