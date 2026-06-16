@extends('themes.formal.layouts.app')

@section('content')
      <!-- Page Header -->
    <section class="bg-emerald-950 text-white py-12 px-4 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('https://images.unsplash.com/photo-1590075865003-e48277adc558')] bg-cover bg-center mix-blend-overlay"></div>
        <div class="relative max-w-7xl mx-auto text-center md:text-left flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold tracking-tight">Galeri Media</h2>
                <p class="text-emerald-300 text-xs mt-1">Dokumentasi lensa kegiatan pembelajaran, lingkungan asrama, dan video profil ma'had</p>
            </div>
            <div class="text-xs text-emerald-400 bg-emerald-900/50 px-4 py-2 rounded border border-emerald-800/60">
                <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a> 
                <span class="mx-2 text-gray-500">/</span> 
                <span class="text-white">Galeri</span>
            </div>
        </div>
    </section>

    <!-- Konten Utama Galeri -->
    <section class="py-16 px-4 bg-white">
        <div class="max-w-7xl mx-auto">
            
            <!-- Grid Pemisah Media -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                
                <!-- KOLOM KIRI: GALERI FOTO (8 Kolom) -->
                <div class="lg:col-span-8">
                    <div class="border-b border-gray-100 pb-3 mb-6">
                        <h3 class="text-lg font-bold text-gray-900 tracking-tight flex items-center gap-2">
                            <i class="fa-regular fa-images text-emerald-700"></i> Dokumentasi Foto Kegiatan
                        </h3>
                    </div>

                    <!-- Grid Foto Dinamis -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @forelse($galeri_foto as $foto)
                        <div class="group relative bg-gray-100 rounded-xl overflow-hidden h-48 border border-gray-100 cursor-pointer shadow-sm hover:shadow-md transition"
                             onclick="openGalleryModal('image', '{{ addslashes($foto->judul) }}', '{{ asset('storage/' . $foto->file) }}')">
                            <img src="{{ asset('storage/' . $foto->file) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" alt="{{ $foto->judul }}">
                            <!-- Overlay Efek Hover -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex flex-col justify-end p-4">
                                <span class="text-emerald-400 text-[10px] font-bold uppercase tracking-wider mb-1">Klik Untuk Memperbesar</span>
                                <h4 class="text-white font-bold text-sm leading-snug line-clamp-2">{{ $foto->judul }}</h4>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-1 sm:col-span-2 bg-slate-50 border border-dashed border-gray-200 rounded-xl p-8 text-center text-xs text-gray-400 italic font-light">
                            Belum ada dokumentasi foto kegiatan yang diunggah oleh pengurus.
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- KOLOM KANAN: GALERI VIDEO (4 Kolom) -->
                <div class="lg:col-span-4 border-t lg:border-t-0 lg:border-l lg:border-gray-100 pt-8 lg:pt-0 lg:pl-8">
                    <div class="border-b border-gray-100 pb-3 mb-6">
                        <h3 class="text-lg font-bold text-gray-900 tracking-tight flex items-center gap-2">
                            <i class="fa-regular fa-circle-play text-emerald-700"></i> Video Dokumenter
                        </h3>
                    </div>

                    <!-- List Stack Video Dinamis -->
                    <div class="space-y-4">
                        @forelse($galeri_video as $video)
                            @php
                                // Helper instan pencari ID unik tautan video YouTube (mendukung format URL pendek & panjang)
                                $youtubeId = '';
                                if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video->link, $match)) {
                                    $youtubeId = $match[1];
                                }
                            @endphp
                            
                            <div class="group bg-white rounded-xl border border-gray-200 p-3 hover:shadow-md transition cursor-pointer flex gap-4 items-center"
                                 onclick="openGalleryModal('video', '{{ addslashes($video->judul) }}', '{{ $youtubeId }}')">
                                <div class="w-24 h-16 bg-slate-900 rounded-lg shrink-0 flex items-center justify-center text-white relative overflow-hidden">
                                    @if(!empty($youtubeId))
                                        <!-- Menampilkan thumbnail bawaan otomatis dari server youtube -->
                                        <img src="https://img.youtube.com/vi/{{ $youtubeId }}/mqdefault.jpg" class="w-full h-full object-cover absolute inset-0 opacity-80 group-hover:scale-105 transition" alt="Thumbnail">
                                    @endif
                                    <i class="fa-solid fa-play text-[10px] bg-emerald-700 text-white w-7 h-7 rounded-full flex items-center justify-center shadow z-10 group-hover:scale-110 transition"></i>
                                    <div class="absolute inset-0 bg-black/20 mix-blend-overlay"></div>
                                </div>
                                <div class="grow min-w-0">
                                    <h4 class="font-bold text-gray-800 text-xs leading-snug group-hover:text-emerald-700 transition line-clamp-2">
                                        {{ $video->judul }}
                                    </h4>
                                    <span class="text-[10px] text-gray-400 block mt-1"><i class="fa-brands fa-youtube mr-1 text-red-600"></i> YouTube Media</span>
                                </div>
                            </div>
                        @empty
                        <div class="bg-slate-50 border border-dashed border-gray-200 rounded-xl p-6 text-center text-xs text-gray-400 italic font-light">
                            Belum ada berkas tautan video dokumenter saat ini.
                        </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- POP-UP MODAL PINTAR GABUNGAN (FOTO & VIDEO) -->
    <div id="mediaPopupModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-slate-950/75 backdrop-blur-sm" onclick="closeGalleryModal()"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Konten Box Utama Modal -->
            <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-2xl shadow-2xl sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full border border-gray-100">
                
                <!-- Container Tampilan Media -->
                <div class="relative bg-black h-[22rem] sm:h-[26rem] flex items-center justify-center">
                    
                    <!-- Wadah Elemen 1: FOTO -->
                    <img id="modalTargetImage" src="" class="hidden w-full h-full object-contain" alt="Preview Foto">

                    <!-- Wadah Elemen 2: VIDEO YOUTUBE (Iframe) -->
                    <div id="modalTargetVideoWrapper" class="hidden w-full h-full">
                        <iframe id="modalTargetYoutubeIframe" class="w-full h-full" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>

                    <!-- Tombol Tutup X Melayang -->
                    <button onclick="closeGalleryModal()" class="absolute top-4 right-4 bg-black/60 hover:bg-black/80 text-white w-9 h-9 rounded-full flex items-center justify-center transition focus:outline-none z-20">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>
                
                <!-- Detail Keterangan Bawah Media -->
                <div class="p-5 bg-white border-t border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                    <h4 class="font-bold text-gray-900 text-xs sm:text-sm tracking-tight" id="modalMediaTitle">Judul Keterangan Media</h4>
                    <button type="button" onclick="closeGalleryModal()" class="w-full sm:w-auto bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold px-5 py-2.5 rounded-xl transition focus:outline-none text-center">
                        Tutup Galeri
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT SYSTEM ENGINE BINDING POPUP -->
    <script>
        function openGalleryModal(type, title, source) {
            document.getElementById('modalMediaTitle').innerText = title;

            const imageEl = document.getElementById('modalTargetImage');
            const videoWrapper = document.getElementById('modalTargetVideoWrapper');
            const iframeEl = document.getElementById('modalTargetYoutubeIframe');

            if (type === 'image') {
                imageEl.src = source;
                imageEl.classList.remove('hidden');
                videoWrapper.classList.add('hidden');
                iframeEl.src = "";
            } else if (type === 'video') {
                imageEl.src = "";
                imageEl.classList.add('hidden');
                videoWrapper.classList.remove('hidden');
                // Mengeset link embed youtube otomatis dengan parameter autoplay=1 pemicu putar instan
                iframeEl.src = `https://www.youtube.com/embed/${source}?autoplay=1`;
            }

            document.getElementById('mediaPopupModal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeGalleryModal() {
            document.getElementById('mediaPopupModal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
            // Hapus isi src iframe saat ditutup agar suara video youtube berhenti berputar di latar belakang
            document.getElementById('modalTargetYoutubeIframe').src = "";
        }
    </script>
@endsection