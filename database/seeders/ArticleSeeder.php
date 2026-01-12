<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage; // Tambahan untuk simpan file
use Illuminate\Support\Str; // Tambahan untuk generate nama file acak

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Cari User Admin
        $user = User::where('email', 'admin@gmail.com')->first();
        if (!$user) {
            $user = User::factory()->create();
        }

        // Pastikan folder article_images ada
        // (Ini akan membuat folder di storage/app/public/article_images)
        Storage::disk('public')->makeDirectory('article_images');

        // 2. Daftar Artikel Dummy + URL Gambar Asli (Unsplash)
        $articles = [
            [
                'title' => 'Mengenal Artificial Intelligence (AI) dan Dampaknya bagi Masa Depan',
                'content' => '<p><strong>Kecerdasan Buatan</strong> atau <em>Artificial Intelligence (AI)</em> telah menjadi topik hangat dalam beberapa tahun terakhir...</p>',
                'published_at' => now()->subDays(2),
                // Gambar Robot / AI
                'image_url' => 'https://images.unsplash.com/photo-1620712943543-bcc4688e7485?w=800&q=80', 
            ],
            [
                'title' => 'Pentingnya Cyber Security di Era Digital',
                'content' => '<p>Di era di mana data adalah mata uang baru, <strong>Keamanan Siber</strong> menjadi sangat krusial...</p>',
                'published_at' => now()->subDays(1),
                // Gambar Matrix / Security
                'image_url' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=800&q=80',
            ],
            [
                'title' => 'Mengapa Laravel Menjadi Framework PHP Terpopuler?',
                'content' => '<p>Bagi para pengembang web, <strong>Laravel</strong> menawarkan sintaks yang elegan dan ekspresif...</p>',
                'published_at' => now(),
                // Gambar Coding / Laptop
                'image_url' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=800&q=80',
            ],
            [
                'title' => 'Internet of Things (IoT): Menghubungkan Segalanya',
                'content' => '<p><strong>Internet of Things (IoT)</strong> adalah konsep komputasi tentang objek sehari-hari...</p>',
                'published_at' => now()->subHours(5),
                // Gambar Chip / IoT
                'image_url' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?w=800&q=80',
            ],
        ];

        // 3. Proses Download & Simpan ke Database
        echo "Sedang mengunduh gambar dummy (membutuhkan internet)...\n";

        foreach ($articles as $data) {
            
            $imagePath = null;

            // Coba download gambar
            try {
                $contents = file_get_contents($data['image_url']);
                $filename = 'article_images/' . Str::random(20) . '.jpg';
                
                // Simpan file ke storage/app/public/article_images
                Storage::disk('public')->put($filename, $contents);
                
                $imagePath = $filename;
            } catch (\Exception $e) {
                // Jika gagal download (misal internet mati), biarkan null
                echo "Gagal download gambar untuk: " . $data['title'] . "\n";
            }

            Article::create([
                'user_id' => $user->id,
                'title' => $data['title'],
                'content' => $data['content'],
                'image' => $imagePath, // Simpan path lokal (misal: article_images/random.jpg)
                'published_at' => $data['published_at'],
            ]);
        }
    }
}