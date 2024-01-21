<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition()
    {
        // Specify the specific IDs for 'User' and 'Librarian'
        $roleIds = ['User' => 1, 'Librarian' => 2];

        // Randomly select 'User' or 'Librarian'
        $roleName = $this->faker->randomElement(['User', 'Librarian']);

        return [
            'id' => $roleIds[$roleName],
            'name' => $roleName,
        ];
    }
}