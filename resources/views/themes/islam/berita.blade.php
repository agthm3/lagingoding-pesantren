@extends('themes.islam.layouts.app')

@section('content')

    <!-- Page Header -->
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

    <!-- Filter Tab & Pencarian Kata Kunci -->
    <section class="pt-12 px-4 bg-white">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4 border-b border-gray-100 pb-6">
            
            <!-- Kategori Kiri (Sistem Tautan Link Aktif) -->
            <div class="flex flex-wrap gap-2 text-xs font-semibold">
                <a href="{{ route('berita', ['search' => $search]) }}" class="px-4 py-2 rounded-full shadow-sm transition {{ empty($category) ? 'bg-emerald-800 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">Semua</a>
                
                <a href="{{ route('berita', ['category' => 'Kegiatan Santri', 'search' => $search]) }}" class="px-4 py-2 rounded-full transition {{ $category === 'Kegiatan Santri' ? 'bg-emerald-800 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">Kegiatan</a>
                
                <a href="{{ route('berita', ['category' => 'Kabar Prestasi', 'search' => $search]) }}" class="px-4 py-2 rounded-full transition {{ $category === 'Kabar Prestasi' ? 'bg-emerald-800 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">Prestasi</a>
                
                <a href="{{ route('berita', ['category' => 'Maklumat Resmi', 'search' => $search]) }}" class="px-4 py-2 rounded-full transition {{ $category === 'Maklumat Resmi' ? 'bg-emerald-800 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">Pengumuman</a>
            </div>
            
            <!-- Kotak Cari Kanan -->
            <form action="{{ route('berita') }}" method="GET" class="relative w-full md:w-72">
                @if($category)
                    <input type="hidden" name="category" value="{{ $category }}">
                @endif
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari berita..." class="w-full text-xs border border-gray-200 rounded-lg pl-9 pr-4 py-2.5 bg-slate-50 focus:outline-none focus:border-emerald-600 focus:bg-white transition font-medium text-slate-800">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-3.5 text-gray-400 text-xs"></i>
            </form>
        </div>
    </section>

    <!-- Daftar Berita Grid Dinamis Database -->
    <section class="py-12 px-4 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                @forelse ($daftar_berita as $item)
                <!-- Card Berita Interaktif -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition duration-300 flex flex-col justify-between cursor-pointer group"
                     onclick="openNewsReaderModal({{ json_encode($item) }}, '{{ asset('storage/' . $item->gambar) }}')">
                    <div>
                        <div class="h-48 bg-slate-50 flex items-center justify-center text-gray-400 relative border-b border-gray-50 overflow-hidden">
                            @if($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            @else
                                <i class="fa-regular fa-image text-3xl text-slate-300"></i>
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
                            <p class="text-gray-500 text-xs leading-relaxed line-clamp-3">
                                {{ strip_tags($item->isi) }}
                            </p>
                        </div>
                    </div>
                    <div class="px-5 pb-5 pt-2 text-xs font-bold text-emerald-700 group-hover:underline flex items-center gap-1">
                        Baca Selengkapnya <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </div>
                </div>
                @empty
                <div class="col-span-1 md:col-span-2 lg:col-span-3 bg-slate-50 border border-slate-200 rounded-2xl p-12 text-center text-slate-400 italic font-medium">
                    Tidak ditemukan publikasi warta berita yang sesuai dengan kriteria filter pencarian Anda.
                </div>
                @endforelse

            </div>
        </div>
    </section>

    <!-- POP-UP MODAL BERITA LENGKAP -->
    <div id="newsReaderModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-950 bg-opacity-60 backdrop-blur-sm" onclick="closeNewsReaderModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-2xl shadow-xl sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full border border-gray-100">
                
                <!-- Gambar Banner Berita di Modal -->
                <div class="h-64 bg-slate-100 flex items-center justify-center text-gray-400 relative border-b border-gray-100 overflow-hidden">
                    <img id="modalNewsImage" src="" class="w-full h-full object-cover hidden" alt="Sampul Berita">
                    <div id="modalNewsImagePlaceholder" class="hidden"><i class="fa-regular fa-image text-5xl text-slate-300"></i></div>
                    
                    <button onclick="closeNewsReaderModal()" class="absolute top-4 right-4 bg-black/40 hover:bg-black/60 text-white w-8 h-8 rounded-full flex items-center justify-center transition focus:outline-none">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>
                
                <!-- Konten Tulisan Artikel -->
                <div class="p-6 md:p-8 overflow-y-auto max-h-[50vh]">
                    <div class="text-[11px] text-gray-400 flex items-center gap-3 mb-3 font-medium">
                        <span id="modalNewsDate"><i class="fa-regular fa-calendar mr-1"></i> Tanggal</span>
                        <span id="modalNewsCategory" class="text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded font-bold">Kategori</span>
                        <span id="modalNewsAuthor" class="text-slate-500 font-normal"><i class="fa-regular fa-user mr-1"></i> Penulis</span>
                    </div>
                    
                    <h3 class="text-lg md:text-xl font-bold text-gray-900 tracking-tight mb-4 leading-snug" id="modalNewsTitle">Judul Berita</h3>
                    
                    <!-- Area rendering isi artikel (Mendukung visualisasi format Rich Text dari Trix Editor) -->
                    <div class="text-xs md:text-sm text-gray-600 leading-relaxed space-y-3 entry-content" id="modalNewsContent">
                        Isi konten artikel lengkap...
                    </div>
                </div>

                <!-- Footer Modal -->
                <div class="bg-gray-50 px-6 py-4 flex justify-end rounded-b-2xl border-t border-gray-100">
                    <button type="button" onclick="closeNewsReaderModal()" class="w-full sm:w-auto bg-gray-200 hover:bg-gray-300 text-gray-700 text-xs font-semibold px-5 py-2 rounded-xl transition focus:outline-none text-center">
                        Selesai Membaca
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- STYLE PERBAIKAN FORMAT TAMPILAN RICH TEXT DI MODAL PUBLIK -->
    <style>
        .entry-content ul { list-style-type: disc !important; margin-left: 1.5rem !important; margin-top: 0.5rem; margin-bottom: 0.5rem; }
        .entry-content ol { list-style-type: decimal !important; margin-left: 1.5rem !important; margin-top: 0.5rem; margin-bottom: 0.5rem; }
        .entry-content strong { font-weight: bold !important; color: #0f172a; }
        .entry-content em { font-style: italic !important; }
    </style>

    <!-- JAVASCRIPT POP-UP INTERAKTIF READER -->
    <script>
        function openNewsReaderModal(item, imageUrl) {
            const modal = document.getElementById('newsReaderModal');
            const imgElement = document.getElementById('modalNewsImage');
            const placeholder = document.getElementById('modalNewsImagePlaceholder');

            // Set Meta Data Informasi teks
            document.getElementById('modalNewsTitle').innerText = item.judul;
            document.getElementById('modalNewsCategory').innerText = item.kategori;
            document.getElementById('modalNewsAuthor').innerHTML = `<i class="fa-regular fa-user mr-1"></i> Oleh: ${item.penulis}`;
            
            // Konversi tanggal pembuatan menggunakan JavaScript Date formatter
            const dateParsed = new Date(item.created_at);
            const dateFormatted = dateParsed.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
            document.getElementById('modalNewsDate').innerHTML = `<i class="fa-regular fa-calendar mr-1"></i> ${dateFormatted}`;

            // Render isi berita sebagai innerHTML agar format Trix Editor (bold, miring, list) aktif sempurna
            document.getElementById('modalNewsContent').innerHTML = item.isi;

            // Logika pengecekan file gambar sampul berita
            if(item.gambar) {
                imgElement.src = imageUrl;
                imgElement.classList.remove('hidden');
                placeholder.classList.add('hidden');
            } else {
                imgElement.classList.add('hidden');
                placeholder.classList.remove('hidden');
            }

            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeNewsReaderModal() {
            const modal = document.getElementById('newsReaderModal');
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    </script>
@endsection