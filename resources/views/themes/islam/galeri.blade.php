@extends('layouts.page.islam.app')

@section('content')
   <!-- Top Bar -->
    <div class="bg-gradient-to-r from-emerald-950 via-emerald-900 to-emerald-950 text-white text-xs py-2.5 px-4 border-b border-amber-500/30">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-2">
            <div class="flex items-center gap-4 text-gray-200">
                <span><i class="fa-solid fa-clock mr-1.5 text-amber-400"></i> Hubungi Kami Aktif: Sabtu - Kamis</span>
                <span class="hidden md:inline">|</span>
                <span><i class="fa-solid fa-envelope mr-1.5 text-amber-400"></i> sekretariat@darussalam.mahad.id</span>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-amber-400 font-serif italic tracking-wide">"Tafaqquh Fiddin"</span>
                <div class="flex items-center gap-3 border-l border-emerald-700/50 pl-3 text-amber-400">
                    <a href="#" class="hover:text-amber-300 transition"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="hover:text-amber-300 transition"><i class="fa-brands fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Header Navigation -->
    <header class="bg-white sticky top-0 z-50 shadow-md border-b-4 border-emerald-800">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-14 h-14 bg-emerald-900 rounded-full flex items-center justify-center text-amber-400 font-bold text-2xl shadow-md border-2 border-amber-400/60">
                    <i class="fa-solid fa-mosque"></i>
                </div>
                <div>
                    <h1 class="font-serif font-bold text-xl text-emerald-900 leading-tight tracking-wide">PONDOK PESANTREN DARUSSALAM</h1>
                    <p class="text-[10px] text-amber-600 font-bold tracking-widest uppercase flex items-center gap-1.5">
                        <i class="fa-solid fa-star text-[8px]"></i> Lembaga Pendidikan Salafiyah Syafi'iyah <i class="fa-solid fa-star text-[8px]"></i>
                    </p>
                </div>
            </div>

            <nav class="hidden lg:flex items-center gap-6 font-semibold text-sm text-emerald-950">
                <a href="index.html" class="hover:text-amber-600 transition">Beranda</a>
                <a href="profile.html" class="hover:text-amber-600 transition">Profil Ma'had</a>
                <a href="madrasah.html" class="hover:text-amber-600 transition">Madrasah</a>
                <a href="kabarkegiatan.html" class="hover:text-amber-600 transition">Kabar Kegiatan</a>
                <a href="#" class="text-amber-600 border-b-2 border-amber-500 pb-1">Galeri Media</a>
                <a href="#" class="hover:text-amber-600 transition">Hubungi</a>
                
                <!-- TOGGLE FITUR: MENU PPDB PREMIUM -->
                <!-- @if(config('features.ppdb')) -->
                <a href="#" class="bg-amber-500 hover:bg-amber-600 text-emerald-950 px-5 py-2 rounded-xl font-bold text-xs tracking-wider transition uppercase shadow border border-amber-400">
                    <i class="fa-solid fa-graduation-cap mr-1"></i> PPDB Online
                </a>
                <!-- @endif -->
            </nav>
        </div>
    </header>

    <!-- Page Header -->
    <section class="bg-emerald-950 text-white py-16 px-4 relative overflow-hidden text-center">
        <div class="absolute inset-0 opacity-10 bg-[url('https://images.unsplash.com/photo-1542838132-92c53300491e')] bg-cover bg-center mix-blend-overlay"></div>
        <div class="relative max-w-4xl mx-auto z-10">
            <h2 class="font-serif text-2xl md:text-4xl font-bold tracking-wide text-white">Lensa & Dokumentasi Media</h2>
            <p class="text-amber-400 font-serif italic text-xs md:text-sm mt-2">Rekam jejak visual khidmah santri, lingkungan pondok, dan majelis ta'lim</p>
            <div class="inline-flex items-center gap-2 mt-4 text-[11px] text-emerald-300 bg-emerald-900/60 px-4 py-1.5 rounded-full border border-emerald-800/60">
                <a href="index.html" class="hover:text-white transition">Beranda</a> 
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

                    <!-- Grid Item Foto -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Card Foto 1 -->
                        <div class="group relative bg-[#fcfbf7] rounded-2xl overflow-hidden h-52 border border-emerald-900/5 cursor-pointer shadow-sm hover:shadow-md transition"
                             onclick="openIslamicGalleryModal('image', 'Kajian Shahih Bukhari Bersama Majelis Masyayikh', 'https://images.unsplash.com/photo-1542838132-92c53300491e')">
                            <!-- Placeholder Gambar Menggunakan Unsplash Khusus Arsitektur/Nuansa Islami -->
                            <img src="https://images.unsplash.com/photo-1542838132-92c53300491e" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" alt="Galeri">
                            <!-- Overlay Khas Islami -->
                            <div class="absolute inset-0 bg-gradient-to-t应用 from-emerald-950/90 via-emerald-950/40 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex flex-col justify-end p-5">
                                <span class="text-[10px] font-bold text-amber-400 uppercase tracking-widest mb-1">Majelis Ilmu</span>
                                <h4 class="font-serif text-white font-bold text-sm leading-snug line-clamp-2">Kajian Shahih Bukhari Bersama Majelis Masyayikh</h4>
                            </div>
                        </div>

                        <!-- Card Foto 2 -->
                        <div class="group relative bg-[#fcfbf7] rounded-2xl overflow-hidden h-52 border border-emerald-900/5 cursor-pointer shadow-sm hover:shadow-md transition"
                             onclick="openIslamicGalleryModal('image', 'Suasana Khidmat Setoran Hafalan Qur\'an Bakda Subuh', 'https://images.unsplash.com/photo-1455734729978-db1ae4f687fc')">
                            <img src="https://images.unsplash.com/photo-1590075865003-e48277adc558" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" alt="Galeri">
                            <div class="absolute inset-0 bg-gradient-to-t应用 from-emerald-950/90 via-emerald-950/40 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex flex-col justify-end p-5">
                                <span class="text-[10px] font-bold text-amber-400 uppercase tracking-widest mb-1">Tahfidzul Qur'an</span>
                                <h4 class="font-serif text-white font-bold text-sm leading-snug line-clamp-2">Suasana Khidmat Setoran Hafalan Qur'an Bakda Subuh</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- KOLOM KANAN: DOKUMENTASI VIDEO YOUTUBE (4 Kolom) -->
                <div class="lg:col-span-4 border-t lg:border-t-0 lg:border-l lg:border-emerald-900/10 pt-8 lg:pt-0 lg:pl-8">
                    <div class="border-b border-emerald-900/10 pb-3 mb-6">
                        <h3 class="font-serif text-lg font-bold text-emerald-950 tracking-wide flex items-center gap-2">
                            <i class="fa-regular fa-circle-play text-amber-500"></i> Video Dokumenter
                        </h3>
                    </div>

                    <!-- List Stack Video -->
                    <div class="space-y-4">
                        <!-- Card Video 1 -->
                        <div class="group bg-[#fcfbf7] rounded-2xl border border-emerald-900/5 p-3 hover:shadow-md transition cursor-pointer flex gap-4 items-center"
                             onclick="openIslamicGalleryModal('video', 'Kilas Profil Resmi Pondok Pesantren Darussalam', 'dQw4w9WgXcQ')">
                            <div class="w-24 h-16 bg-emerald-950 rounded-xl shrink-0 flex items-center justify-center text-white relative overflow-hidden border border-amber-500/20 shadow-inner">
                                <i class="fa-solid fa-play text-xs bg-amber-500 text-emerald-950 w-7 h-7 rounded-full flex items-center justify-center shadow z-10 group-hover:scale-110 transition duration-300"></i>
                                <div class="absolute inset-0 bg-black/40 mix-blend-overlay"></div>
                            </div>
                            <div>
                                <h4 class="font-serif font-bold text-emerald-950 text-xs leading-snug group-hover:text-amber-600 transition line-clamp-2">
                                    Kilas Profil Resmi Pondok Pesantren Darussalam
                                </h4>
                                <span class="text-[9px] text-amber-600 font-bold block mt-1"><i class="fa-brands fa-youtube mr-1 text-red-600"></i> MULTIMEDIA SANTRI</span>
                            </div>
                        </div>

                        <!-- Card Video 2 -->
                        <div class="group bg-[#fcfbf7] rounded-2xl border border-emerald-900/5 p-3 hover:shadow-md transition cursor-pointer flex gap-4 items-center"
                             onclick="openIslamicGalleryModal('video', 'Dokumentasi Khutbah Ikhtitam & Wisuda Kelulusan Aliyah', 'dQw4w9WgXcQ')">
                            <div class="w-24 h-16 bg-emerald-950 rounded-xl shrink-0 flex items-center justify-center text-white relative overflow-hidden border border-amber-500/20 shadow-inner">
                                <i class="fa-solid fa-play text-xs bg-amber-500 text-emerald-950 w-7 h-7 rounded-full flex items-center justify-center shadow z-10 group-hover:scale-110 transition duration-300"></i>
                                <div class="absolute inset-0 bg-black/40 mix-blend-overlay"></div>
                            </div>
                            <div>
                                <h4 class="font-serif font-bold text-emerald-950 text-xs leading-snug group-hover:text-amber-600 transition line-clamp-2">
                                    Dokumentasi Khutbah Ikhtitam & Wisuda Kelulusan Madrasah Aliyah
                                </h4>
                                <span class="text-[9px] text-amber-600 font-bold block mt-1"><i class="fa-brands fa-youtube mr-1 text-red-600"></i> DOKUMENTASI MA'HAD</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- POP-UP MODAL MULTIMEDIA PINTAR -->
    <div id="islamicMediaModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background Overlay Gelap Blur -->
            <div class="fixed inset-0 transition-opacity bg-emerald-950/50 bg-opacity-75 backdrop-blur-sm" onclick="closeIslamicGalleryModal()"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Konten Utama Frame Modal (Mendukung 16:9 Rasio Video: max-w-3xl) -->
            <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-2xl shadow-2xl sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full border-2 border-amber-500/20">
                
                <!-- Kontainer Inti Render Media -->
                <div class="relative bg-black h-[24rem] sm:h-[28rem] flex items-center justify-center">
                    
                    <!-- Mode Gambar -->
                    <img id="targetIslamicImage" src="" class="hidden w-full h-full object-contain" alt="Preview Foto">

                    <!-- Mode Video YouTube -->
                    <div id="targetIslamicVideoWrapper" class="hidden w-full h-full">
                        <iframe id="targetIslamicIframe" class="w-full h-full" src="" title="Ma'had Video Player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>

                    <!-- Tombol X Melayang Pojok Kanan Atas -->
                    <button onclick="closeIslamicGalleryModal()" class="absolute top-4 right-4 bg-emerald-950/70 hover:bg-emerald-950/90 text-white w-9 h-9 rounded-full flex items-center justify-center transition focus:outline-none z-20 border border-amber-500/20">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>
                
                <!-- Detail Bar Bawah Modal -->
                <div class="p-5 bg-[#fcfbf7] border-t border-emerald-900/5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                    <h4 class="font-serif font-bold text-emerald-950 text-sm tracking-wide" id="targetIslamicMediaTitle">Keterangan Judul Gambar/Video</h4>
                    <button type="button" onclick="closeIslamicGalleryModal()" class="w-full sm:w-auto bg-emerald-950 hover:bg-emerald-900 text-amber-300 border border-amber-500/20 text-xs font-bold px-5 py-2 rounded-xl transition focus:outline-none text-center">
                        Tutup Media
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection