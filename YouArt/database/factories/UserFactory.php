<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => null, 
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
            'role' => $this->faker->randomElement(['artist', 'amateur']),
            'location' => $this->faker->city,
            'bio' => $this->faker->paragraph,
            'profile_photo' => null,
        ];
    }

    // verified users
    public function verified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => now(),
            ];
        });
    }
}