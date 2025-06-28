<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Level;

class LevelUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil level yang sudah ada
        $adminLevel = Level::where('name', 'Admin')->first();
        $userLevel = Level::where('name', 'User')->first();

        // Hapus user demo yang lama jika ada
        User::where('email', 'admin@example.com')->delete();
        User::where('email', 'user@example.com')->delete();

        // Buat user admin baru dengan credentials yang lebih aman
        $adminUser = User::create([
            'name' => 'Administrator',
            'email' => 'admin@portfolioweb.com',
            'password' => bcrypt('Admin123!'),
        ]);

        // Buat user regular baru dengan credentials yang lebih aman
        $regularUser = User::create([
            'name' => 'Regular User',
            'email' => 'user@portfolioweb.com',
            'password' => bcrypt('User123!'),
        ]);

        // Assign level ke user
        $adminUser->levels()->attach($adminLevel->id);
        $regularUser->levels()->attach($userLevel->id);

        // Jika ada user lain yang sudah ada, assign level berdasarkan kondisi tertentu
        $existingUsers = User::whereNotIn('email', ['admin@portfolioweb.com', 'user@portfolioweb.com'])->get();
        
        foreach ($existingUsers as $user) {
            // User dengan email yang mengandung 'admin' akan mendapat level Admin
            if (str_contains(strtolower($user->email), 'admin')) {
                $user->levels()->sync([$adminLevel->id]);
            } else {
                // User lain mendapat level User
                $user->levels()->sync([$userLevel->id]);
            }
        }
    }
} 