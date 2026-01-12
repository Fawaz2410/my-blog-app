<x-app-layout>
    {{-- Style Khusus CKEditor --}}
    @push('styles')
    <style>
        .ck-editor__editable_inline {
            min-height: 400px;
        }
        .ck-content ul {
            list-style-type: disc;
            padding-left: 20px;
        }
        .ck-content ol {
            list-style-type: decimal;
            padding-left: 20px;
        }
        .ck-content h2 {
            font-size: 1.5em;
            font-weight: bold;
        }
        .ck-content h3 {
            font-size: 1.17em;
            font-weight: bold;
        }
        .ck-content a {
            color: #4f46e5;
            text-decoration: underline;
        }
    </style>
    @endpush

    <x-slot name="header">
        <div class="flex items-center text-sm font-medium text-gray-500">
            <a href="{{ route('dashboard') }}" class="hover:text-indigo-600 transition">Dashboard</a>
            <svg class="w-3 h-3 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="text-gray-900 font-bold">Edit Artikel</span>
        </div>
    </x-slot>

    <div class="py-12 font-sans">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            {{-- Error Handling --}}
            @if ($errors->any())
                <div class="mb-5 bg-red-50 border-l-4 border-red-500 p-4 shadow-sm rounded-r">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-bold text-red-800">Gagal mengupdate artikel:</h3>
                            <ul class="mt-1 list-disc list-inside text-sm text-red-700">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            {{-- FORM EDIT --}}
            <form action="{{ route('articles.update', $article) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-xl sm:rounded-2xl overflow-hidden border border-gray-100">
                @csrf
                @method('PUT') {{-- PENTING: Untuk Update Data --}}
                
                <div class="px-8 py-6 border-b border-gray-50 bg-gray-50/50 flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-bold text-gray-900">Edit Konten</h2>
                        <p class="text-xs text-gray-500 mt-1">Perbarui tulisanmu agar tetap relevan.</p>
                    </div>
                    <div class="h-8 w-8 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </div>
                </div>

                <div class="p-8 space-y-6">
                    {{-- JUDUL --}}
                    <div>
                        <label for="title" class="block text-sm font-bold text-gray-700 mb-2">Judul Artikel</label>
                        <input type="text" name="title" id="title" 
                            value="{{ old('title', $article->title) }}"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition shadow-sm placeholder-gray-400 text-lg py-3 font-medium" 
                            required>
                    </div>

                    {{-- GAMBAR SAMPUL --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Cover Image (Gambar Sampul)</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="image" class="relative flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition overflow-hidden group">
                                
                                {{-- Logic Tampilan: Placeholder vs Existing Image --}}
                                <div id="upload-placeholder" class="flex flex-col items-center justify-center pt-5 pb-6 {{ $article->image ? 'hidden' : '' }}">
                                    <svg class="w-8 h-8 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk ganti</span> gambar</p>
                                    <p class="text-xs text-gray-500">Biarkan kosong jika tidak ingin mengubah</p>
                                </div>

                                {{-- Image Preview Tag --}}
                                <img id="image-preview" 
                                     src="{{ $article->image ? asset('storage/' . $article->image) : '#' }}" 
                                     alt="Preview" 
                                     class="{{ $article->image ? '' : 'hidden' }} w-full h-full object-cover absolute top-0 left-0 group-hover:opacity-90 transition">
                                
                                {{-- Overlay Text on Hover (Optional UX improvement) --}}
                                <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-30 opacity-0 group-hover:opacity-100 transition duration-300">
                                    <p class="text-white font-bold text-sm">Klik untuk ganti gambar</p>
                                </div>

                                <input id="image" name="image" type="file" class="hidden" accept="image/*" onchange="previewImage(event)" />
                            </label>
                        </div>
                    </div>

                    {{-- TANGGAL PUBLIKASI --}}
                    <div>
                        <label for="published_at" class="block text-sm font-bold text-gray-700 mb-2">Tanggal Publikasi</label>
                        <input type="date" name="published_at" id="published_at" 
                            value="{{ old('published_at', $article->published_at) }}"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition shadow-sm text-gray-600">
                    </div>

                    {{-- KONTEN CKEDITOR --}}
                    <div>
                        <label for="content" class="block text-sm font-bold text-gray-700 mb-2">Isi Artikel</label>
                        <div class="relative">
                            {{-- Kita gunakan {!! !!} agar tag HTML dari database terbaca oleh CKEditor --}}
                            <textarea name="content" id="content" class="hidden">{!! old('content', $article->content) !!}</textarea>
                        </div>
                    </div>
                </div>

                {{-- TOMBOL ACTION --}}
                <div class="px-8 py-5 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                    <a href="{{ route('dashboard') }}" class="text-sm font-medium text-gray-500 hover:text-gray-900 transition">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition shadow-lg shadow-indigo-200 transform hover:-translate-y-0.5">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        Update Artikel
                    </button>
                </div>

            </form>
        </div>
    </div>

    {{-- SCRIPT AREA --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('image-preview');
            const placeholder = document.getElementById('upload-placeholder');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        ClassicEditor
            .create(document.querySelector('#content'), {
                toolbar: [ 
                    'heading', '|', 
                    'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 
                    '|', 'undo', 'redo' 
                ],
            })
            .catch(error => {
                console.error(error);
            });
    </script>
</x-app-layout>