<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'published_at', 'user_id', 'image'];

    // Relasi: Artikel dimiliki oleh User (Penulis)
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}