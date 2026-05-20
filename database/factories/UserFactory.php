<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),

            'email' => fake()->unique()->safeEmail(),

            'cp_number' => '09' . fake()->numerify('#########'),

            'role' => fake()->randomElement([
                'Coordinator',
                'Developer',
                'Member',
                'Officer',
                'Secretary',
                'Treasurer',
            ]),
            'team' => fake()->randomElement([
                'Old Testament',
                'New Testament',
            ]),

            'status' => fake()->randomElement([
                'active',
                'inactive',
            ]),

            'password' => Hash::make('password123'),

            'membership_expiration' => fake()->dateTimeBetween(
                'now',
                '+1 year'
            ),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
