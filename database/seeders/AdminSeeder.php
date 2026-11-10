<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Gunakan withoutTimestamps agar tidak memicu cast 'hashed' dua kali
        // Model memiliki cast password => 'hashed', sehingga cukup passing string plain
        Admin::updateOrCreate(
            [
                'email' => 'admin@bumdes.id',
            ],
            [
                'name' => 'Admin BUMDes Karangkemiri',
                'username' => 'admin_bumdes',
                'password' => 'password123',
            ]
        );
    }
}
