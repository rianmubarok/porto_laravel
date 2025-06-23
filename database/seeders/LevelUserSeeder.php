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

        // Ambil user yang sudah ada (atau buat dummy user)
        $users = User::all();

        if ($users->isEmpty()) {
            // Jika tidak ada user, buat dummy user
            $adminUser = User::create([
                'name' => 'Administrator',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
            ]);

            $regularUser = User::create([
                'name' => 'Regular User',
                'email' => 'user@example.com',
                'password' => bcrypt('password'),
            ]);

            // Assign level ke user
            $adminUser->levels()->attach($adminLevel->id);
            $regularUser->levels()->attach($userLevel->id);
        } else {
            // Jika sudah ada user, assign level berdasarkan kondisi tertentu
            foreach ($users as $user) {
                // Contoh: user dengan email admin akan mendapat level Admin
                if (str_contains(strtolower($user->email), 'admin')) {
                    $user->levels()->sync([$adminLevel->id]);
                } else {
                    // User lain mendapat level User
                    $user->levels()->sync([$userLevel->id]);
                }
            }
        }

        // Alternatif: Assign multiple levels ke satu user
        // $firstUser = User::first();
        // if ($firstUser) {
        //     $firstUser->levels()->attach([$adminLevel->id, $userLevel->id]);
        // }
    }
} 