<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Article;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat User SUPER ADMIN
        $superAdmin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'], 
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'role' => 'super_admin', // <--- PENTING: Set sebagai Super Admin
            ]
        );

        // 2. Buat User PENULIS BIASA (Untuk testing)
        $writer = User::firstOrCreate(
            ['email' => 'penulis@gmail.com'], 
            [
                'name' => 'Penulis Biasa',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'role' => 'writer', // <--- Set sebagai Penulis biasa
            ]
        );

        // 3. Buat Artikel Dumy
        // Buat 3 artikel milik Super Admin
        Article::factory(3)->create([
            'user_id' => $superAdmin->id
        ]);

        // Buat 3 artikel milik Penulis Biasa
        Article::factory(3)->create([
            'user_id' => $writer->id
        ]);
        $this->call([
            ArticleSeeder::class,
        ]);
    }
}