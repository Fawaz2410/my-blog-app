<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center text-sm font-medium text-gray-500">
            <a href="{{ route('dashboard') }}" class="hover:text-indigo-600 transition">Dashboard</a>
            <svg class="w-3 h-3 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="text-gray-900 font-bold">Tulis Artikel Baru</span>
        </div>
    </x-slot>

    <div class="py-12 font-sans">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-xl sm:rounded-2xl overflow-hidden border border-gray-100">
                @csrf
                
                <div class="px-8 py-6 border-b border-gray-50 bg-gray-50/50 flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-bold text-gray-900">Editor Konten</h2>
                        <p class="text-xs text-gray-500 mt-1">Tuangkan idemu menjadi tulisan yang menarik.</p>
                    </div>
                    <div class="h-8 w-8 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </div>
                </div>

                <div class="p-8 space-y-6">
                    <div>
                        <label for="title" class="block text-sm font-bold text-gray-700 mb-2">Judul Artikel</label>
                        <input type="text" name="title" id="title" 
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition shadow-sm placeholder-gray-400 text-lg py-3 font-medium" 
                            placeholder="Contoh: Tutorial Laravel 11 untuk Pemula..." required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Cover Image (Gambar Sampul)</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="image" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span> gambar</p>
                                    <p class="text-xs text-gray-500">JPG, PNG, GIF (Max. 2MB)</p>
                                </div>
                                <input id="image" name="image" type="file" class="hidden" accept="image/*" />
                            </label>
                        </div>
                    </div>

                    <div>
                        <label for="published_at" class="block text-sm font-bold text-gray-700 mb-2">Tanggal Publikasi</label>
                        <input type="date" name="published_at" id="published_at" 
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition shadow-sm text-gray-600">
                        <p class="text-[10px] text-gray-400 mt-2">*Kosongkan jika ingin menyimpannya sebagai DRAFT.</p>
                    </div>

                    <div>
                        <label for="content" class="block text-sm font-bold text-gray-700 mb-2">Isi Artikel</label>
                        <div class="relative group">
                            <div class="flex items-center gap-2 px-3 py-2 bg-gray-50 border border-b-0 border-gray-300 rounded-t-lg text-gray-500 text-sm">
                                <span class="p-1 hover:bg-gray-200 rounded cursor-pointer font-bold">B</span>
                                <span class="p-1 hover:bg-gray-200 rounded cursor-pointer italic">I</span>
                                <span class="p-1 hover:bg-gray-200 rounded cursor-pointer underline">U</span>
                                <div class="w-[1px] h-4 bg-gray-300 mx-1"></div>
                                <span class="p-1 hover:bg-gray-200 rounded cursor-pointer">H1</span>
                                <span class="p-1 hover:bg-gray-200 rounded cursor-pointer">H2</span>
                                <span class="ml-auto text-[10px] text-gray-400">Markdown Supported</span>
                            </div>
                            
                            <textarea name="content" id="content" rows="12" 
                                class="w-full border-gray-300 rounded-b-lg focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition shadow-sm font-mono text-sm leading-relaxed p-4" 
                                placeholder="Mulai menulis cerita inspiratifmu di sini..." required></textarea>
                        </div>
                    </div>
                </div>

                <div class="px-8 py-5 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                    <a href="{{ route('dashboard') }}" class="text-sm font-medium text-gray-500 hover:text-gray-900 transition">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition shadow-lg shadow-indigo-200 transform hover:-translate-y-0.5">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                        Simpan Artikel
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>