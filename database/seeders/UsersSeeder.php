<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        User::factory(5)->create([
            'password' => bcrypt('supersecret')
        ])->each(function (User $user) {
            Task::factory()->create([
                'user_id' => $user->id
            ]);
        });
    }
}
