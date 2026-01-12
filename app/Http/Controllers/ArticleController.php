<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User; // <--- INI KUNCI PERBAIKANNYA (Import Model User)
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    // Tampilan Publik
    public function index()
    {
        $articles = Article::whereNotNull('published_at')
                            ->latest('published_at')
                            ->paginate(9);

        return view('welcome', compact('articles'));
    }

    // Tampilan Detail
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    // Tampilan Dashboard Admin
    public function adminIndex()
    {
        /** @var User $user */ // <--- VS Code sekarang sudah kenal 'User' dari import di atas
        $user = Auth::user();

        if ($user->isSuperAdmin()) {
            $articles = Article::with('author')->latest()->paginate(10);
        } else {
            $articles = Article::where('user_id', $user->id)->latest()->paginate(10);
        }
        
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

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
        /** @var User $user */
        $user = Auth::user();

        if ($article->user_id !== $user->id && !$user->isSuperAdmin()) {
            abort(403, 'Anda tidak berhak mengedit artikel ini.');
        }

        return view('articles.edit', compact('article'));
    }

    // Update Data
    public function update(Request $request, Article $article)
    {
        /** @var User $user */
        $user = Auth::user();

        if ($article->user_id !== $user->id && !$user->isSuperAdmin()) {
            abort(403);
        }

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'published_at' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($article->image && Storage::disk('public')->exists($article->image)) {
                Storage::disk('public')->delete($article->image);
            }
            $path = $request->file('image')->store('article_images', 'public');
            $validatedData['image'] = $path;
        }

        $article->update($validatedData);

        return redirect()->route('dashboard')->with('success', 'Artikel diperbarui!');
    }

    // Fitur Toggle Publish/Draft
    public function togglePublish(Article $article)
    {
        /** @var User $user */
        $user = Auth::user();

        if ($article->user_id !== $user->id && !$user->isSuperAdmin()) {
            abort(403);
        }

        if ($article->published_at) {
            $article->update(['published_at' => null]);
            $message = 'Artikel ditarik ke Draft (Disembunyikan).';
        } else {
            $article->update(['published_at' => now()]);
            $message = 'Artikel berhasil diterbitkan!';
        }

        return redirect()->back()->with('success', $message);
    }

    // Hapus Data
    public function destroy(Article $article)
    {
        /** @var User $user */
        $user = Auth::user();

        if ($article->user_id !== $user->id && !$user->isSuperAdmin()) {
            abort(403);
        }
        
        if ($article->image && Storage::disk('public')->exists($article->image)) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();
        return redirect()->route('dashboard')->with('success', 'Artikel berhasil dihapus.');
    }
}