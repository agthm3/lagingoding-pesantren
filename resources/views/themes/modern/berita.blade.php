@extends('themes.modern.layouts.app')

@section('content')

    <section class="max-w-7xl mx-auto px-4 pt-12">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 border-b border-slate-200 pb-6">
            <div class="flex flex-wrap gap-2 text-xs font-bold">
                <a href="{{ route('berita', ['search' => $search]) }}" class="px-5 py-2.5 rounded-xl shadow-sm border transition text-center {{ empty($category) ? 'bg-slate-900 text-cyan-400 border-slate-700' : 'bg-white text-slate-600 hover:bg-slate-100 border-slate-200' }}">Semua</a>
                <a href="{{ route('berita', ['category' => 'Kegiatan', 'search' => $search]) }}" class="px-5 py-2.5 rounded-xl border transition text-center {{ $category === 'Kegiatan' ? 'bg-slate-900 text-cyan-400 border-slate-700' : 'bg-white text-slate-600 hover:bg-slate-100 border-slate-200' }}">Kegiatan</a>
                <a href="{{ route('berita', ['category' => 'Prestasi', 'search' => $search]) }}" class="px-5 py-2.5 rounded-xl border transition text-center {{ $category === 'Prestasi' ? 'bg-slate-900 text-cyan-400 border-slate-700' : 'bg-white text-slate-600 hover:bg-slate-100 border-slate-200' }}">Prestasi</a>
                <a href="{{ route('berita', ['category' => 'Pengumuman', 'search' => $search]) }}" class="px-5 py-2.5 rounded-xl border transition text-center {{ $category === 'Pengumuman' ? 'bg-slate-900 text-cyan-400 border-slate-700' : 'bg-white text-slate-600 hover:bg-slate-100 border-slate-200' }}">Pengumuman</a>
            </div>
            
            <form action="{{ route('berita') }}" method="GET" class="relative w-full md:w-72">
                @if($category)
                    <input type="hidden" name="category" value="{{ $category }}">
                @endif
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari artikel warta..." class="w-full text-xs border border-slate-200 rounded-xl pl-9 pr-4 py-3 bg-white focus:outline-none focus:border-teal-500 shadow-inner transition">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-3.5 text-slate-400 text-xs"></i>
            </form>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            @forelse ($daftar_berita as $item)
            <div class="bg-white rounded-2xl border border-slate-200/60 overflow-hidden hover:border-slate-300 hover:shadow-xl transition duration-300 flex flex-col justify-between cursor-pointer group"
                 onclick="openModernNewsModal('{{ addslashes($item->judul) }}', '{{ $item->created_at->translatedFormat('d F Y') }}', '{{ $item->kategori }}', '{{ addslashes($item->isi) }}', '{{ $item->gambar ? asset('storage/' . $item->gambar) : '' }}')">
                <div>
                    <div class="h-48 bg-slate-100 flex items-center justify-center text-slate-300 border-b border-slate-100 relative overflow-hidden">
                        @if($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        @else
                            <i class="fa-regular fa-image text-3xl group-hover:scale-105 transition duration-300"></i>
                        @endif
                        <span class="absolute top-4 left-4 bg-slate-900 text-cyan-400 text-[9px] font-bold px-2.5 py-1 rounded-md uppercase tracking-wider">{{ $item->kategori }}</span>
                    </div>
                    <div class="p-6">
                        <div class="text-[10px] text-slate-400 flex items-center gap-2 mb-2 font-semibold">
                            <span><i class="fa-regular fa-calendar mr-1"></i> {{ $item->created_at->translatedFormat('d M Y') }}</span>
                        </div>
                        <h4 class="font-bold text-slate-900 text-base mb-2 group-hover:text-teal-600 transition line-clamp-2 leading-snug">
                            {{ $item->judul }}
                        </h4>
                        <p class="text-slate-500 text-xs leading-relaxed font-light line-clamp-3">
                            {{ strip_tags($item->isi) }}
                        </p>
                    </div>
                </div>
                <div class="px-6 pb-6 pt-2 text-xs font-bold text-teal-600 group-hover:underline flex items-center gap-1">
                    Baca Artikel <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </div>
            </div>
            @empty
            <div class="col-span-1 md:col-span-2 lg:col-span-3 bg-white border border-dashed border-slate-200 rounded-2xl p-12 text-center text-slate-400 italic font-light">
                Tidak ditemukan publikasi artikel warta kegiatan yang sesuai dengan kriteria pencarian Anda.
            </div>
            @endforelse

        </div>
    </section>

    <div id="modernNewsModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-slate-950 bg-opacity-60 backdrop-blur-sm" onclick="closeModernNewsModal()"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-3xl shadow-2xl sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full border border-slate-200">
                
                <div id="modalWartaImageContainer" class="h-64 bg-slate-100 flex items-center justify-center text-slate-300 relative border-b border-slate-100 overflow-hidden">
                    <img id="modalWartaImage" src="" class="w-full h-full object-cover hidden" alt="Banner Berita">
                    <div id="modalWartaPlaceholder" class="flex flex-col items-center justify-center"><i class="fa-regular fa-image text-4xl"></i></div>
                    
                    <button onclick="closeModernNewsModal()" class="absolute top-4 right-4 bg-slate-950/40 hover:bg-slate-950/60 text-white w-8 h-8 rounded-full flex items-center justify-center transition focus:outline-none z-20">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>
                
                <div class="p-6 md:p-8">
                    <div class="text-[10px] text-slate-400 flex items-center gap-3 mb-2 font-semibold">
                        <span id="modalWartaDate"><i class="fa-regular fa-calendar mr-1"></i> Tanggal</span>
                        <span id="modalWartaCategory" class="text-teal-600 bg-teal-50 px-2 py-0.5 rounded-md font-bold">Kategori</span>
                    </div>
                    
                    <h3 class="text-lg md:text-xl font-black text-slate-900 tracking-tight mb-4 leading-snug" id="modalWartaTitle">Judul Lengkap Berita</h3>
                    <p class="text-xs md:text-sm text-slate-500 leading-relaxed font-light whitespace-pre-line max-h-80 overflow-y-auto p-1" id="modalWartaContent">Konten komplit artikel...</p>
                </div>

                <div class="bg-slate-50 px-6 py-4 flex justify-end rounded-b-3xl border-t border-slate-200/60">
                    <button type="button" onclick="closeModernNewsModal()" class="w-full sm:w-auto bg-slate-900 hover:bg-slate-800 text-cyan-400 text-xs font-bold px-5 py-2.5 rounded-xl transition focus:outline-none border border-slate-700 shadow-sm">
                        Selesai Membaca
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModernNewsModal(title, date, category, content, imageUrl) {
            document.getElementById('modalWartaTitle').innerText = title;
            document.getElementById('modalWartaDate').innerHTML = `<i class="fa-regular fa-calendar mr-1"></i> ${date}`;
            document.getElementById('modalWartaCategory').innerText = category;
            document.getElementById('modalWartaContent').innerHTML = content;

            const imgEl = document.getElementById('modalWartaImage');
            const placeholderEl = document.getElementById('modalWartaPlaceholder');

            if(imageUrl) {
                imgEl.src = imageUrl;
                imgEl.classList.remove('hidden');
                placeholderEl.classList.add('hidden');
            } else {
                imgEl.src = "";
                imgEl.classList.add('hidden');
                placeholderEl.classList.remove('hidden');
            }

            document.getElementById('modernNewsModal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeModernNewsModal() {
            document.getElementById('modernNewsModal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    </script>
@endsection