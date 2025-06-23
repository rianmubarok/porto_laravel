<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Level;

class LevelSeeder extends Seeder
{
    public function run()
    {
    // Masukkan data ke dalam tabel levels
    Level::create(['name' => 'Admin', 'description' => 'Administrator level']);
    Level::create(['name' => 'User', 'description' => 'Regular user level']);
    // Tambahkan level lain jika diperlukan
    }
}
