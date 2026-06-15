@extends('themes.islam.layouts.app')

@section('content')
    <!-- Page Header -->
    <section class="bg-emerald-950 text-white py-16 px-4 relative overflow-hidden text-center">
        <div class="absolute inset-0 opacity-10 bg-[url('https://images.unsplash.com/photo-1542838132-92c53300491e')] bg-cover bg-center mix-blend-overlay"></div>
        <div class="relative max-w-4xl mx-auto z-10">
            <h2 class="font-serif text-2xl md:text-4xl font-bold tracking-wide text-white">Lensa & Dokumentasi Media</h2>
            <p class="text-amber-400 font-serif italic text-xs md:text-sm mt-2">Rekam jejak visual khidmah santri, lingkungan pondok, dan majelis ta'lim</p>
            <div class="inline-flex items-center gap-2 mt-4 text-[11px] text-emerald-300 bg-emerald-900/60 px-4 py-1.5 rounded-full border border-emerald-800/60">
                <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a> 
                <span class="text-emerald-700">/</span> 
                <span class="text-white">Galeri Media</span>
            </div>
        </div>
    </section>

    <!-- Seksi Utama Galeri Media -->
    <section class="py-16 px-4 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                
                <!-- KOLOM KIRI: DOKUMENTASI FOTO (8 Kolom) -->
                <div class="lg:col-span-8">
                    <div class="border-b border-emerald-900/10 pb-3 mb-6 flex items-center gap-2">
                        <h3 class="font-serif text-lg font-bold text-emerald-950 tracking-wide flex items-center gap-2">
                            <i class="fa-regular fa-images text-amber-500"></i> Khazanah Foto Kegiatan
                        </h3>
                    </div>

                    <!-- Grid Item Foto Dinamis -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @forelse ($galeri_foto as $foto)
                        <div class="group relative bg-[#fcfbf7] rounded-2xl overflow-hidden h-52 border border-emerald-900/5 cursor-pointer shadow-sm hover:shadow-md transition duration-300"
                             onclick="openIslamicGalleryModal('image', '{{ addslashes($foto->judul) }}', '{{ asset('storage/' . $foto->konten) }}')">
                            <img src="{{ asset('storage/' . $foto->konten) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" alt="{{ $foto->judul }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-emerald-950/90 via-emerald-950/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex flex-col justify-end p-5">
                                <span class="text-[10px] font-bold text-amber-400 uppercase tracking-widest mb-1">Dokumentasi Ma'had</span>
                                <h4 class="font-serif text-white font-bold text-sm leading-snug line-clamp-2">{{ $foto->judul }}</h4>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-2 bg-slate-50 border border-slate-100 text-center text-slate-400 italic py-12 rounded-2xl text-xs font-medium">
                            Belum ada dokumentasi foto kegiatan yang diunggah.
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- KOLOM KANAN: DOKUMENTASI VIDEO YOUTUBE (4 Kolom) -->
                <div class="lg:col-span-4 border-t lg:border-t-0 lg:border-l lg:border-emerald-900/10 pt-8 lg:pt-0 lg:pl-8">
                    <div class="border-b border-emerald-900/10 pb-3 mb-6">
                        <h3 class="font-serif text-lg font-bold text-emerald-950 tracking-wide flex items-center gap-2">
                            <i class="fa-regular fa-circle-play text-amber-500"></i> Video Dokumenter
                        </h3>
                    </div>

                    <!-- List Stack Video Dinamis -->
                    <div class="space-y-4">
                        @forelse ($galeri_video as $video)
                        <div class="group bg-[#fcfbf7] rounded-2xl border border-emerald-900/5 p-3 hover:shadow-md transition cursor-pointer flex gap-4 items-center"
                             onclick="openIslamicGalleryModal('video', '{{ addslashes($video->judul) }}', '{{ $video->konten }}')">
                            <div class="w-24 h-16 bg-emerald-950 rounded-xl shrink-0 flex items-center justify-center text-white relative overflow-hidden border border-amber-500/20 shadow-inner">
                                <img src="https://img.youtube.com/vi/{{ $video->konten }}/mqdefault.jpg" class="absolute inset-0 w-full h-full object-cover opacity-60" alt="Thumb">
                                <i class="fa-solid fa-play text-xs bg-amber-500 text-emerald-950 w-7 h-7 rounded-full flex items-center justify-center shadow static z-10 group-hover:scale-110 transition duration-300"></i>
                            </div>
                            <div>
                                <h4 class="font-serif font-bold text-emerald-950 text-xs leading-snug group-hover:text-amber-600 transition line-clamp-2">
                                    {{ $video->judul }}
                                </h4>
                                <span class="text-[9px] text-amber-600 font-bold block mt-1"><i class="fa-brands fa-youtube mr-1 text-red-600"></i> MULTIMEDIA SANTRI</span>
                            </div>
                        </div>
                        @empty
                        <div class="bg-slate-50 border border-slate-100 text-center text-slate-400 italic p-6 rounded-2xl text-xs font-medium">
                            Belum ada dokumentasi video ma'had yang disematkan.
                        </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- POP-UP MODAL MULTIMEDIA PINTAR -->
    <div id="islamicMediaModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-emerald-950/50 bg-opacity-75 backdrop-blur-sm" onclick="closeIslamicGalleryModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-2xl shadow-2xl sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full border-2 border-amber-500/20">
                <div class="relative bg-black h-[24rem] sm:h-[28rem] flex items-center justify-center">
                    
                    <!-- Mode Gambar -->
                    <img id="targetIslamicImage" src="" class="hidden w-full h-full object-contain" alt="Preview Foto">

                    <!-- Mode Video YouTube -->
                    <div id="targetIslamicVideoWrapper" class="hidden w-full h-full">
                        <iframe id="targetIslamicIframe" class="w-full h-full" src="" title="Ma'had Video Player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>

                    <button onclick="closeIslamicGalleryModal()" class="absolute top-4 right-4 bg-emerald-950/70 hover:bg-emerald-950/90 text-white w-9 h-9 rounded-full flex items-center justify-center transition focus:outline-none z-20 border border-amber-500/20">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>
                
                <div class="p-5 bg-[#fcfbf7] border-t border-emerald-900/5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                    <h4 class="font-serif font-bold text-emerald-950 text-sm tracking-wide" id="targetIslamicMediaTitle">Keterangan Judul</h4>
                    <button type="button" onclick="closeIslamicGalleryModal()" class="w-full sm:w-auto bg-emerald-950 hover:bg-emerald-900 text-amber-300 border border-amber-500/20 text-xs font-bold px-5 py-2 rounded-xl transition focus:outline-none text-center">
                        Tutup Media
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT MODAL GALERI INTERAKTIF -->
    <script>
        function openIslamicGalleryModal(type, title, source) {
            const modal = document.getElementById('islamicMediaModal');
            const imgTarget = document.getElementById('targetIslamicImage');
            const videoWrapper = document.getElementById('targetIslamicVideoWrapper');
            const iframeTarget = document.getElementById('targetIslamicIframe');
            
            document.getElementById('targetIslamicMediaTitle').innerText = title;

            if (type === 'image') {
                imgTarget.src = source;
                imgTarget.classList.remove('hidden');
                videoWrapper.classList.add('hidden');
                iframeTarget.src = ""; 
            } else {
                imgTarget.classList.add('hidden');
                imgTarget.src = "";
                videoWrapper.classList.remove('hidden');
                // Menggunakan URL embed YouTube resmi berbasis ID video dari database
                iframeTarget.src = `https://www.youtube.com/embed/${source}?autoplay=1`;
            }

            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeIslamicGalleryModal() {
            const modal = document.getElementById('islamicMediaModal');
            document.getElementById('targetIslamicIframe').src = ""; // Stop video player secara paksa saat modal ditutup
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    </script>
@endsection