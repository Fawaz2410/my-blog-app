<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    // Tampilan Publik: Semua orang bisa lihat
    public function index()
    {
        // PERBAIKAN: Hanya tampilkan artikel yang published_at TIDAK KOSONG (Bukan Draft)
        $articles = Article::whereNotNull('published_at')
                           ->latest('published_at')
                           ->get();

        return view('welcome', compact('articles'));
    }

    // Tampilan Detail Artikel
    public function show(Article $article)
    {
        // Opsional: Jika ingin artikel draft tidak bisa diakses lewat URL langsung oleh publik
        // if (!$article->published_at && $article->user_id !== Auth::id()) {
        //     abort(404); 
        // }

        return view('articles.show', compact('article'));
    }

    // Tampilan Admin: Dashboard List Artikel Saya
    public function adminIndex()
    {
        // Hanya menampilkan artikel milik user yang sedang login
        $articles = Article::where('user_id', Auth::id())->latest()->get();
        return view('dashboard', compact('articles'));
    }

    // Form Tambah
    public function create()
    {
        return view('articles.create');
    }

    // Simpan Data
public function store(Request $request)
{
    $validatedData = $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
        'published_at' => 'nullable|date',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi Gambar
    ]);

    // LOGIKA UPLOAD
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('article_images', 'public');
        $validatedData['image'] = $path;
    }

    $validatedData['user_id'] = Auth::id();

    Article::create($validatedData);

    return redirect()->route('dashboard')->with('success', 'Artikel berhasil dibuat!');
}
    // Form Edit
    public function edit(Article $article)
    {
        // Proteksi: Pastikan yang edit adalah penulisnya
        if ($article->user_id !== Auth::id()) {
            abort(403);
        }
        return view('articles.edit', compact('article'));
    }

    // Update Data
    public function update(Request $request, Article $article)
{
    if ($article->user_id !== Auth::id()) abort(403);

    $validatedData = $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
        'published_at' => 'nullable|date',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // LOGIKA UPLOAD & HAPUS GAMBAR LAMA
    if ($request->hasFile('image')) {
        // Hapus gambar lama jika ada
        if ($article->image && Storage::disk('public')->exists($article->image)) {
            Storage::disk('public')->delete($article->image);
        }
        // Simpan gambar baru
        $path = $request->file('image')->store('article_images', 'public');
        $validatedData['image'] = $path;
    }

    $article->update($validatedData);

    return redirect()->route('dashboard')->with('success', 'Artikel diperbarui!');
}

    // Fitur Toggle Publish/Draft
    public function togglePublish(Article $article)
    {
        // Pastikan hanya pemilik yang bisa ubah
        if ($article->user_id !== Auth::id()) abort(403);

        if ($article->published_at) {
            // Jika sedang tayang -> Ubah jadi NULL (Draft)
            $article->update(['published_at' => null]);
            $message = 'Artikel ditarik ke Draft (Disembunyikan).';
        } else {
            // Jika sedang draft -> Isi dengan tanggal sekarang (Publish)
            $article->update(['published_at' => now()]);
            $message = 'Artikel berhasil diterbitkan!';
        }

        return redirect()->back()->with('success', $message);
    }

    // Hapus Data
    public function destroy(Article $article)
{
    if ($article->user_id !== Auth::id()) abort(403);
    
    // Hapus gambar dari storage
    if ($article->image && Storage::disk('public')->exists($article->image)) {
        Storage::disk('public')->delete($article->image);
    }

    $article->delete();
    return redirect()->route('dashboard')->with('success', 'Artikel dihapus.');
}
}