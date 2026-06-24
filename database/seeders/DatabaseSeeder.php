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
        User::factory()->create([
            'username' => 'Enji',
            'name' => 'enji_admin',
            'email' => 'enji@dr.com'
        ]);

        User::factory()->create([
            'username' => 'Ani',
            'name' => 'Ani',
            'email' => 'ani@dr.com'
        ]);

        User::factory()->create([
            'username' => 'Zidan',
            'name' => 'Zidan',
            'email' => 'zidan@dr.com'
        ]);
    }
}
