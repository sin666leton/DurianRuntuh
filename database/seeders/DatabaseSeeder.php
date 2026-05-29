<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\TypeItem;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->createOne([
            'username' => 'testing',
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
