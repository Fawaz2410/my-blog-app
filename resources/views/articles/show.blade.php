<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $article->title }} - InfoTekno</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        /* Tambahan style manual jika Tailwind Typography belum terinstall */
        .prose ul { list-style-type: disc; padding-left: 1.5rem; margin-bottom: 1rem; }
        .prose ol { list-style-type: decimal; padding-left: 1.5rem; margin-bottom: 1rem; }
        .prose h2 { font-size: 1.5rem; font-weight: 700; margin-top: 2rem; margin-bottom: 1rem; color: #1e293b; }
        .prose h3 { font-size: 1.25rem; font-weight: 600; margin-top: 1.5rem; margin-bottom: 0.75rem; color: #334155; }
        .prose blockquote { border-left: 4px solid #3b82f6; padding-left: 1rem; font-style: italic; color: #475569; }
        .prose strong { color: #0f172a; font-weight: 700; }
        .prose a { color: #2563eb; text-decoration: underline; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased selection:bg-blue-600 selection:text-white">

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
                    <a href="{{ route('home') }}" class="text-sm font-semibold text-slate-500 hover:text-blue-600 transition flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 py-12">
        
        <header class="mb-10 text-center max-w-2xl mx-auto">
            <div class="flex items-center justify-center gap-2 mb-6">
                <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-xs font-bold uppercase tracking-wider border border-blue-100">
                    Article
                </span>
                <span class="text-slate-400 text-xs font-bold">&bull;</span>
                <span class="text-slate-500 text-xs font-bold uppercase tracking-wider">
                    {{ \Carbon\Carbon::parse($article->published_at)->format('d F Y') }}
                </span>
            </div>

            <h1 class="text-3xl md:text-5xl font-extrabold text-slate-900 mb-8 leading-tight">
                {{ $article->title }}
            </h1>

            <div class="flex items-center justify-center gap-3">
                <div class="w-12 h-12 rounded-full border-2 border-white shadow-md overflow-hidden bg-slate-200">
                    @if($article->author->avatar ?? false)
                        <img src="{{ asset('storage/' . $article->author->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
                    @else
                        {{-- Saya tambahkan null coalescing operator ?? '' agar tidak error jika author dihapus --}}
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($article->author->name ?? 'Admin') }}&background=E2E8F0&color=475569" class="w-full h-full object-cover" alt="Avatar">
                    @endif
                </div>
                <div class="text-left">
                    <p class="text-sm font-bold text-slate-900">{{ $article->author->name ?? 'Admin' }}</p>
                    <p class="text-xs text-slate-500">Penulis Blog</p>
                </div>
            </div>
        </header>

        <div class="mb-12 rounded-2xl overflow-hidden shadow-2xl shadow-blue-900/10 border border-slate-100">
            @if($article->image)
                <img src="{{ asset('storage/' . $article->image) }}" class="w-full h-auto object-cover" alt="Article Cover">
            @else
                <img src="https://picsum.photos/seed/{{ $article->id }}/1200/600" class="w-full h-auto object-cover" alt="Article Cover">
            @endif
        </div>

        {{-- PERUBAHAN UTAMA DI SINI --}}
        <article class="prose prose-lg prose-slate mx-auto text-slate-600 leading-loose">
            {{-- Gunakan syntax ini untuk merender HTML dari CKEditor --}}
            {!! $article->content !!}
        </article>

        <div class="mt-16 pt-8 border-t border-slate-200 flex justify-center">
            <a href="{{ route('home') }}" class="px-6 py-3 bg-white border border-slate-200 text-slate-700 font-bold rounded-full hover:bg-slate-50 hover:border-slate-300 transition shadow-sm">
                &larr; Baca Artikel Lainnya
            </a>
        </div>

    </main>

    <footer class="bg-white border-t border-slate-200 py-12 mt-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-2xl font-bold text-slate-900 mb-4">Info<span class="text-blue-600">Tekno</span>.</h2>
            <p class="text-slate-400 text-sm">
                &copy; {{ date('Y') }} Dibuat dengan Laravel  & Tailwind CSS.
            </p>
        </div>
    </footer>

</body>
</html>