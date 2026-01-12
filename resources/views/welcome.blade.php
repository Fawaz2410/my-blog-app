<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Teknologi Informasi - Blog Mahasiswa PTI</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased selection:bg-blue-600 selection:text-white">

    {{-- NAVBAR --}}
    <nav class="sticky top-0 z-50 w-full bg-white/80 backdrop-blur-md border-b border-slate-200 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                
                <a href="/" class="group flex items-center gap-2">
                    <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-blue-600/30 group-hover:scale-110 transition-transform">
                        I
                    </div>
                    <span class="text-xl font-bold text-slate-900 tracking-tight">Info<span class="text-blue-600">Tekno</span>.</span>
                </a>

                <div class="flex items-center gap-4">
                    @if (Route::has('login'))
                                        @auth
                                <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition">Dashboard</a>
                                
                                {{-- Garis Pemisah --}}
                                <div class="h-4 w-[1px] bg-slate-300"></div>

                                {{-- Container Foto & Nama --}}
                                <div class="flex items-center gap-2">
                                    {{-- Logika Foto: Jika ada avatar di DB tampilkan, jika tidak pakai inisial --}}
                                    <div class="w-8 h-8 rounded-full bg-slate-200 overflow-hidden border border-slate-300">
                                        @if(Auth::user()->avatar)
                                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
                                        @else
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0F172A&color=fff" alt="Avatar" class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                    
                                    <span class="text-sm font-bold text-slate-900">{{ Auth::user()->name }}</span>
                                </div>
                            @else
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-600 hover:text-slate-900 px-4 py-2 hover:bg-slate-100 rounded-full transition">Masuk</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-sm font-bold bg-slate-900 text-white px-5 py-2.5 rounded-full hover:bg-slate-800 hover:shadow-lg transition transform hover:-translate-y-0.5">Daftar Sekarang</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    {{-- HERO SECTION --}}
    <section class="relative pt-20 pb-32 overflow-hidden">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full z-0 pointer-events-none">
            <div class="absolute top-20 left-10 w-72 h-72 bg-blue-400/20 rounded-full blur-3xl mix-blend-multiply animate-pulse"></div>
            <div class="absolute top-20 right-10 w-72 h-72 bg-purple-400/20 rounded-full blur-3xl mix-blend-multiply animate-pulse" style="animation-delay: 2s"></div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
            <span class="inline-block py-1 px-3 rounded-full bg-blue-50 border border-blue-100 text-blue-600 text-xs font-bold tracking-wider uppercase mb-6">
                Blog Mahasiswa PTI &bull;  2026
            </span>
            <h1 class="text-5xl md:text-7xl font-extrabold text-slate-900 tracking-tight mb-8 leading-tight">
                Jelajahi Wawasan <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">Tanpa Batas.</span>
            </h1>
            <p class="text-xl text-slate-500 mb-10 max-w-2xl mx-auto leading-relaxed">
                Temukan artikel terbaru seputar pemrograman dan teknologi masa depan.
            </p>
            <div class="flex justify-center gap-4">
                <a href="#latest" class="px-8 py-4 bg-blue-600 text-white font-bold rounded-full shadow-xl shadow-blue-600/20 hover:bg-blue-700 hover:shadow-blue-600/40 transition transform hover:-translate-y-1">
                    Mulai Membaca
                </a>
                <a href="https://github.com/Fawaz2410" target="_blank" class="px-8 py-4 bg-white text-slate-700 font-bold rounded-full border border-slate-200 hover:border-slate-400 hover:bg-slate-50 transition">
                    Lihat Github
                </a>
            </div>
        </div>
    </section>

    {{-- LATEST ARTICLES --}}
    <section id="latest" class="py-20 bg-white border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex items-end justify-between mb-12">
                <div>
                    <h2 class="text-3xl font-bold text-slate-900">Tulisan Terbaru</h2>
                    <p class="mt-2 text-slate-500">Update wawasanmu hari ini.</p>
                </div>
                <div class="hidden md:block w-1/3 h-[1px] bg-slate-200 mb-2"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($articles as $article)
                <article class="group flex flex-col bg-white rounded-2xl border border-slate-100 overflow-hidden hover:shadow-2xl hover:shadow-blue-900/5 transition-all duration-300 transform hover:-translate-y-1 h-full">
                    
                    {{-- IMAGE --}}
                    <div class="relative h-56 overflow-hidden">
                        @if($article->image)
                            <img src="{{ asset('storage/' . $article->image) }}" alt="Cover" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        @else
                            <img src="https://picsum.photos/seed/{{ $article->id }}/800/600" alt="Cover" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        @endif

                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-60 group-hover:opacity-40 transition-opacity"></div>
                        
                        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur text-slate-800 text-xs font-bold px-3 py-1.5 rounded-lg shadow-sm">
                            {{ \Carbon\Carbon::parse($article->published_at)->format('d M Y') }}
                        </div>
                    </div>

                    {{-- CONTENT --}}
                    <div class="p-6 flex flex-col flex-1">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded-md uppercase tracking-wider">Article</span>
                        </div>

                        <h3 class="text-xl font-bold text-slate-900 mb-3 leading-snug group-hover:text-blue-600 transition-colors">
                            <a href="{{ route('article.show', $article) }}">
                                {{ Str::limit($article->title, 60) }}
                            </a>
                        </h3>
                        
                        {{-- PERBAIKAN PENTING DI SINI --}}
                        {{-- Menggunakan strip_tags agar tag HTML CKEditor tidak bocor ke tampilan kartu --}}
                        <p class="text-slate-500 text-sm leading-relaxed mb-6 line-clamp-3 flex-1">
                            {{ Str::limit(strip_tags($article->content), 110) }}
                        </p>

                        <div class="pt-5 border-t border-slate-100 flex items-center justify-between mt-auto">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full border-2 border-white shadow-sm overflow-hidden bg-slate-200">
                                    {{-- Cek Avatar dengan null coalescing --}}
                                    @if($article->author->avatar ?? false)
                                        <img src="{{ asset('storage/' . $article->author->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($article->author->name ?? 'Admin') }}&background=E2E8F0&color=475569" class="w-full h-full object-cover" alt="Avatar">
                                    @endif
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-xs font-bold text-slate-700">{{ $article->author->name ?? 'Admin' }}</span>
                                    <span class="text-[10px] text-slate-400">Penulis</span>
                                </div>
                            </div>
                            
                            <a href="{{ route('article.show', $article) }}" class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-blue-600 hover:text-white transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            {{-- PAGINATION --}}
            {{-- Tambahkan ini jika controller kamu menggunakan ->paginate() --}}
            @if($articles instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="mt-12">
                    {{ $articles->links() }}
                </div>
            @endif

            {{-- EMPTY STATE --}}
            @if($articles->isEmpty())
                <div class="flex flex-col items-center justify-center py-24 bg-slate-50 rounded-3xl border border-dashed border-slate-300 text-center">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-sm mb-4 text-slate-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Belum ada artikel</h3>
                    <p class="text-slate-500 max-w-xs mx-auto mt-2">Sepertinya admin belum mempublikasikan tulisan apapun.</p>
                </div>
            @endif

        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-white border-t border-slate-200 py-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-2xl font-bold text-slate-900 mb-4">Info<span class="text-blue-600">Tekno</span>.</h2>
            <div class="flex justify-center gap-6 mb-8 text-slate-500">
                <a href="#" class="hover:text-blue-600 transition">Tentang Kami</a>
                <a href="#" class="hover:text-blue-600 transition">Kebijakan Privasi</a>
                <a href="#" class="hover:text-blue-600 transition">Kontak</a>
            </div>
            <p class="text-slate-400 text-sm">
                &copy; {{ date('Y') }} Dibuat dengan Laravel  & Tailwind CSS.
            </p>
        </div>
    </footer>

</body>
</html>