<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'test@authguard.hello',
            'password' => Hash::make('admin@789')
        ])->assignRole('admin');

        User::factory()->create([
            'name' => 'Standard User',
            'email' => 'standard@authguard.hello',
            'password' => Hash::make('standard@123')
        ])->assignRole('standard');
    }
}
