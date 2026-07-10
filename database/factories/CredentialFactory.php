<?php

namespace Database\Factories;

use App\Models\Credential;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Credential>
 */
class CredentialFactory extends Factory
{
    protected $model = Credential::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->sentence(3),
            'type' => fake()->randomElement(['education', 'work', 'certificate', 'id']),
            'issuer' => fake()->company(),
            'issue_date' => fake()->date(),
            'expiry_date' => fake()->optional()->date(),
            'file_path' => 'credentials/' . fake()->uuid() . '.pdf',
            'status' => 'pending',
            'description' => fake()->paragraph(),
        ];
    }
}
