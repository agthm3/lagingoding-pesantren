@extends('themes.formal.layouts.app')

@section('content')

    <section class="bg-emerald-950 text-white py-12 px-4 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('https://images.unsplash.com/photo-1590075865003-e48277adc558')] bg-cover bg-center mix-blend-overlay"></div>
        <div class="relative max-w-7xl mx-auto text-center md:text-left flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold tracking-tight">Kabar Pesantren</h2>
                <p class="text-emerald-300 text-xs mt-1">Portal berita resmi, pengumuman, dan dokumentasi agenda kegiatan ma'had</p>
            </div>
            <div class="text-xs text-emerald-400 bg-emerald-900/50 px-4 py-2 rounded border border-emerald-800/60">
                <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a> 
                <span class="mx-2 text-gray-500">/</span> 
                <span class="text-white">Berita</span>
            </div>
        </div>
    </section>

    <section class="pt-12 px-4 bg-white">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4 border-b border-gray-100 pb-6">
            <div class="flex flex-wrap gap-2 text-xs font-semibold">
                <a href="{{ route('berita', ['search' => $search]) }}" class="px-4 py-2 rounded-full transition shadow-sm {{ empty($category) ? 'bg-emerald-800 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">Semua</a>
                <a href="{{ route('berita', ['category' => 'Kegiatan', 'search' => $search]) }}" class="px-4 py-2 rounded-full transition {{ $category === 'Kegiatan' ? 'bg-emerald-800 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">Kegiatan</a>
                <a href="{{ route('berita', ['category' => 'Prestasi', 'search' => $search]) }}" class="px-4 py-2 rounded-full transition {{ $category === 'Prestasi' ? 'bg-emerald-800 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">Prestasi</a>
                <a href="{{ route('berita', ['category' => 'Pengumuman', 'search' => $search]) }}" class="px-4 py-2 rounded-full transition {{ $category === 'Pengumuman' ? 'bg-emerald-800 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">Pengumuman</a>
            </div>
            
            <form action="{{ route('berita') }}" method="GET" class="relative w-full md:w-72">
                @if($category)
                    <input type="hidden" name="category" value="{{ $category }}">
                @endif
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari berita..." class="w-full text-xs border border-gray-200 rounded-lg pl-9 pr-4 py-2.5 bg-gray-50 focus:outline-none focus:border-emerald-600 focus:bg-white transition">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-3.5 text-gray-400 text-xs"></i>
            </form>
        </div>
    </section>

    <section class="py-12 px-4 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                @forelse ($daftar_berita as $item)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition flex flex-col justify-between cursor-pointer group"
                     onclick="openNewsModal('{{ addslashes($item->judul) }}', '{{ $item->created_at->translatedFormat('d F Y') }}', '{{ $item->kategori }}', '{{ addslashes($item->isi) }}', '{{ $item->gambar ? asset('storage/' . $item->gambar) : '' }}')">
                    <div>
                        <div class="h-48 bg-gray-100 flex items-center justify-center text-gray-400 relative border-b border-gray-50 overflow-hidden">
                            @if($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            @else
                                <i class="fa-regular fa-image text-3xl group-hover:scale-105 transition duration-300"></i>
                            @endif
                        </div>
                        <div class="p-5">
                            <div class="text-[11px] text-gray-400 flex items-center gap-3 mb-2 font-medium">
                                <span><i class="fa-regular fa-calendar mr-1"></i> {{ $item->created_at->translatedFormat('d M Y') }}</span>
                                <span class="text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded font-bold"><i class="fa-regular fa-folder mr-1"></i> {{ $item->kategori }}</span>
                            </div>
                            <h4 class="font-bold text-gray-900 text-base mb-2 group-hover:text-emerald-700 transition line-clamp-2">
                                {{ $item->judul }}
                            </h4>
                            <p class="text-gray-500 text-xs leading-relaxed line-clamp-3 font-light">
                                {{ strip_tags($item->isi) }}
                            </p>
                        </div>
                    </div>
                    <div class="px-5 pb-5 pt-2 text-xs font-bold text-emerald-700 group-hover:underline flex items-center gap-1">
                        Baca Selengkapnya <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </div>
                </div>
                @empty
                <div class="col-span-1 md:col-span-2 lg:col-span-3 bg-slate-50 border border-dashed border-gray-200 rounded-2xl p-12 text-center text-gray-400 italic font-light">
                    Tidak ditemukan warta wacana kabar berita yang sesuai dengan kata kunci atau filter pencarian Anda.
                </div>
                @endforelse

            </div>
        </div>
    </section>

    <div id="newsModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-60 backdrop-blur-sm" onclick="closeNewsModal()"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-2xl shadow-xl sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full border border-gray-100">
                
                <div id="modalNewsImageContainer" class="h-64 bg-gray-100 flex items-center justify-center text-gray-400 relative border-b border-gray-100 overflow-hidden">
                    <img id="modalNewsImage" src="" class="w-full h-full object-cover hidden" alt="Banner Artikel">
                    <div id="modalNewsPlaceholder" class="flex flex-col items-center justify-center"><i class="fa-regular fa-image text-5xl"></i></div>
                    
                    <button onclick="closeNewsModal()" class="absolute top-4 right-4 bg-black/40 hover:bg-black/60 text-white w-8 h-8 rounded-full flex items-center justify-center transition focus:outline-none z-20">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>
                
                <div class="p-6 md:p-8">
                    <div class="text-[11px] text-gray-400 flex items-center gap-3 mb-3 font-medium">
                        <span id="modalNewsDate"><i class="fa-regular fa-calendar mr-1"></i> Tanggal</span>
                        <span id="modalNewsCategory" class="text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded font-bold">Kategori</span>
                    </div>
                    
                    <h3 class="text-lg md:text-xl font-bold text-gray-900 tracking-tight mb-4 leading-snug" id="modalNewsTitle">Judul Berita Lengkap</h3>
                    
                    <p class="text-xs md:text-sm text-gray-600 leading-relaxed whitespace-pre-line font-light shadow-inner max-h-80 overflow-y-auto p-1" id="modalNewsContent">Isi konten artikel lengkap...</p>
                </div>

                <div class="bg-gray-50 px-6 py-4 flex justify-end rounded-b-2xl border-t border-gray-100">
                    <button type="button" onclick="closeNewsModal()" class="w-full sm:w-auto bg-gray-200 hover:bg-gray-300 text-gray-700 text-xs font-semibold px-5 py-2 rounded transition focus:outline-none">
                        Selesai Membaca
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openNewsModal(title, date, category, content, imageUrl) {
            document.getElementById('modalNewsTitle').innerText = title;
            document.getElementById('modalNewsDate').innerHTML = `<i class="fa-regular fa-calendar mr-1"></i> ${date}`;
            document.getElementById('modalNewsCategory').innerText = category;
            document.getElementById('modalNewsContent').innerHTML = content;

            const imgEl = document.getElementById('modalNewsImage');
            const placeholderEl = document.getElementById('modalNewsPlaceholder');

            if(imageUrl) {
                imgEl.src = imageUrl;
                imgEl.classList.remove('hidden');
                placeholderEl.classList.add('hidden');
            } else {
                imgEl.src = "";
                imgEl.classList.add('hidden');
                placeholderEl.classList.remove('hidden');
            }

            document.getElementById('newsModal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeNewsModal() {
            document.getElementById('newsModal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    </script>
@endsection