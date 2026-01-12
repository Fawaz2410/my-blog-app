<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="font-bold text-xl text-gray-800 leading-tight">
                    {{-- JUDUL DINAMIS --}}
                    @if(auth()->user()->isSuperAdmin())
                        {{ __('Dashboard Super Admin') }}
                    @else
                        {{ __('Dashboard Penulis') }}
                    @endif
                </h2>
                <p class="text-xs text-gray-500 mt-1">
                    @if(auth()->user()->isSuperAdmin())
                        Pantau seluruh aktivitas artikel dan penulis.
                    @else
                        Kelola semua tulisan dan idemu di sini.
                    @endif
                </p>
            </div>
            
            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    Lihat Blog
                </a>
                <span class="hidden md:block h-6 w-[1px] bg-gray-300"></span>
                <span class="hidden md:block text-sm text-gray-500 font-medium bg-gray-100 px-3 py-1 rounded-full border border-gray-200">
                    {{ now()->format('d M Y') }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 font-sans">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- STATS CARDS --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Card 1 --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 p-6 flex items-center relative group hover:shadow-md transition">
                    <div class="absolute right-0 top-0 w-24 h-24 bg-indigo-50 rounded-bl-full -mr-4 -mt-4 transition group-hover:bg-indigo-100"></div>
                    <div class="relative z-10 p-3 rounded-xl bg-indigo-50 text-indigo-600 mr-4 group-hover:scale-110 transition">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    </div>
                    <div class="relative z-10">
                        <div class="text-sm font-medium text-gray-500">
                            @if(auth()->user()->isSuperAdmin()) Total Seluruh Artikel @else Total Artikel Saya @endif
                        </div>
                        <div class="text-2xl font-bold text-gray-900">{{ $articles->total() }}</div>
                    </div>
                </div>
                
                {{-- Card 2 --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 p-6 flex items-center relative group hover:shadow-md transition">
                    <div class="absolute right-0 top-0 w-24 h-24 bg-green-50 rounded-bl-full -mr-4 -mt-4 transition group-hover:bg-green-100"></div>
                    <div class="relative z-10 p-3 rounded-xl bg-green-50 text-green-600 mr-4 group-hover:scale-110 transition">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="relative z-10">
                        <div class="text-sm font-medium text-gray-500">Role Akun</div>
                        <div class="text-lg font-bold text-gray-900 capitalize">{{ auth()->user()->role == 'super_admin' ? 'Super Admin' : 'Writer' }}</div>
                    </div>
                </div>

                {{-- Card 3 (CTA) --}}
                <div class="bg-gradient-to-br from-indigo-600 to-blue-700 overflow-hidden shadow-lg shadow-indigo-200 sm:rounded-xl p-6 flex items-center justify-between text-white relative">
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white opacity-10 rounded-full blur-xl"></div>
                    <div class="relative z-10">
                        <div class="text-sm font-medium text-indigo-100">Mulai Menulis</div>
                        <div class="text-lg font-bold">Bagikan Ide Baru</div>
                    </div>
                    <a href="{{ route('articles.create') }}" class="relative z-10 p-2 bg-white/20 hover:bg-white text-white hover:text-indigo-600 rounded-lg transition backdrop-blur-sm border border-white/30">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </a>
                </div>
            </div>

            {{-- NOTIFIKASI --}}
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-transition class="bg-emerald-50 border border-emerald-200 p-4 rounded-xl shadow-sm flex justify-between items-center">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-emerald-100 rounded-full p-1">
                            <svg class="h-5 w-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <p class="ml-3 text-sm text-emerald-700 font-medium">{{ session('success') }}</p>
                    </div>
                    <button @click="show = false" class="text-emerald-500 hover:text-emerald-700 transition">&times;</button>
                </div>
            @endif

            {{-- TABEL ARTIKEL --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div class="p-6 border-b border-gray-50 bg-gray-50/30 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">
                            @if(auth()->user()->isSuperAdmin()) Daftar Semua Tulisan @else Daftar Tulisan Anda @endif
                        </h3>
                        <p class="text-xs text-gray-500">
                            @if(auth()->user()->isSuperAdmin()) Kelola artikel dari semua penulis. @else Kelola artikel yang telah Anda buat. @endif
                        </p>
                    </div>
                    
                    <a href="{{ route('articles.create') }}" class="md:hidden inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
                        + Buat
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Artikel</th>
                                
                                {{-- KOLOM KHUSUS SUPER ADMIN --}}
                                @if(auth()->user()->isSuperAdmin())
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Penulis</th>
                                @endif

                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tanggal Terbit</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse($articles as $article)
                            <tr class="hover:bg-gray-50/80 transition duration-150 group">
                                <td class="px-6 py-4">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 h-12 w-12 relative">
                                            @if($article->image)
                                                <img class="h-12 w-12 rounded-lg object-cover shadow-sm border border-gray-100" src="{{ asset('storage/' . $article->image) }}" alt="">
                                            @else
                                                <img class="h-12 w-12 rounded-lg object-cover shadow-sm border border-gray-100" src="https://picsum.photos/seed/{{ $article->id }}/100/100" alt="">
                                            @endif
                                        </div>
                                        <div class="ml-4 max-w-xs">
                                            <div class="text-sm font-bold text-gray-900 group-hover:text-indigo-600 transition">
                                                {{ Str::limit($article->title, 40) }}
                                            </div>
                                            <div class="text-xs text-gray-500 mt-1">
                                                {{ Str::limit(strip_tags($article->content), 50) }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                
                                {{-- ISI KOLOM KHUSUS SUPER ADMIN --}}
                                @if(auth()->user()->isSuperAdmin())
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-8 w-8">
                                            <img class="h-8 w-8 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode($article->author->name ?? 'User') }}&background=E2E8F0&color=475569" alt="">
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $article->author->name ?? 'Tidak Diketahui' }}
                                                @if(auth()->id() == $article->user_id)
                                                    <span class="ml-1 text-[10px] bg-blue-100 text-blue-600 px-1.5 py-0.5 rounded font-bold">(Anda)</span>
                                                @endif
                                            </div>
                                            <div class="text-xs text-gray-500">{{ $article->author->email ?? '-' }}</div>
                                        </div>
                                    </div>
                                </td>
                                @endif

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-semibold text-gray-700">
                                            {{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->format('d M Y') : '-' }}
                                        </span>
                                        <span class="text-[10px] text-gray-400">
                                            {{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->diffForHumans() : 'Draft' }}
                                        </span>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($article->published_at)
                                        <span class="px-3 py-1 inline-flex text-[10px] uppercase font-bold tracking-wide rounded-full bg-emerald-100 text-emerald-700 border border-emerald-200">
                                            Published
                                        </span>
                                    @else
                                        <span class="px-3 py-1 inline-flex text-[10px] uppercase font-bold tracking-wide rounded-full bg-gray-100 text-gray-600 border border-gray-200">
                                            Draft
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end items-center gap-2">
                                        
                                        {{-- Toggle Publish --}}
                                        <form action="{{ route('articles.toggle', $article) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                class="w-8 h-8 flex items-center justify-center rounded-lg transition {{ $article->published_at ? 'bg-orange-50 text-orange-500 hover:bg-orange-100' : 'bg-emerald-50 text-emerald-600 hover:bg-emerald-100' }}" 
                                                title="{{ $article->published_at ? 'Tarik ke Draft' : 'Terbitkan' }}">
                                                @if($article->published_at)
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" /></svg>
                                                @else
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                                @endif
                                            </button>
                                        </form>

                                        {{-- Edit --}}
                                        <a href="{{ route('articles.edit', $article) }}" class="w-8 h-8 flex items-center justify-center rounded-lg bg-indigo-50 text-indigo-600 hover:bg-indigo-100 hover:text-indigo-700 transition" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        </a>
                                        
                                        {{-- Delete --}}
                                        <form action="{{ route('articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus artikel ini? Tindakan ini tidak dapat dibatalkan.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 text-red-600 hover:bg-red-100 hover:text-red-700 transition" title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="{{ auth()->user()->isSuperAdmin() ? 5 : 4 }}" class="px-6 py-20 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="bg-gray-100 p-4 rounded-full mb-4">
                                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                        </div>
                                        <h3 class="text-lg font-medium text-gray-900">Belum ada artikel</h3>
                                        <p class="text-gray-500 mb-6 text-sm">Tidak ada artikel yang ditemukan.</p>
                                        <a href="{{ route('articles.create') }}" class="inline-flex items-center px-5 py-2.5 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
                                            Buat Artikel Baru
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION --}}
                @if($articles instanceof \Illuminate\Pagination\LengthAwarePaginator && $articles->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                        {{ $articles->links() }}
                    </div>
                @endif
            </div>
            
            <div class="text-center text-xs text-gray-400 mt-8">
                &copy; {{ date('Y') }} Sistem Informasi Manajemen Blog Mahasiswa.
            </div>
        </div>
    </div>
</x-app-layout>