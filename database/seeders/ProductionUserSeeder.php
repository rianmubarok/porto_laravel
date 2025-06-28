<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Level;

class ProductionUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil level yang sudah ada
        $adminLevel = Level::where('name', 'Admin')->first();
        $userLevel = Level::where('name', 'User')->first();

        // Buat user admin production
        $adminUser = User::updateOrCreate(
            ['email' => 'admin@portfolioweb.com'],
            [
                'name' => 'Administrator',
                'password' => bcrypt('Admin123!'),
            ]
        );

        // Buat user regular production
        $regularUser = User::updateOrCreate(
            ['email' => 'user@portfolioweb.com'],
            [
                'name' => 'Regular User',
                'password' => bcrypt('User123!'),
            ]
        );

        // Assign level ke user
        $adminUser->levels()->sync([$adminLevel->id]);
        $regularUser->levels()->sync([$userLevel->id]);

        $this->command->info('Production users created successfully!');
        $this->command->info('Admin: admin@portfolioweb.com / Admin123!');
        $this->command->info('User: user@portfolioweb.com / User123!');
    }
} 