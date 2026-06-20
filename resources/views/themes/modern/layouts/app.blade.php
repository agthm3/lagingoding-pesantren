<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesantren Modern Darussalam - Pendidikan Islam Masa Depan</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 text-slate-800 antialiased font-sans">

    <!-- Navbar / Header (Gaya Melayang - Floating Header Style) -->
    <div class="w-full px-4 pt-4 sticky top-0 z-50">
        <header class="max-w-7xl mx-auto bg-white/90 backdrop-blur-md rounded-2xl border border-slate-200/60 shadow-lg px-6 py-4 flex justify-between items-center">
            
            <!-- Logo & Identitas -->
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-tr from-slate-900 to-indigo-950 rounded-xl flex items-center justify-center text-cyan-400 font-bold text-lg shadow-md">
                    <i class="fa-solid fa-layer-group"></i>
                </div>
                <div>
                    <h1 class="font-extrabold text-base text-slate-900 leading-tight tracking-tight">DARUSSALAM <span class="text-teal-600 font-medium">MODERN</span></h1>
                    <p class="text-[9px] text-slate-400 font-semibold tracking-widest uppercase">Pesantren Modern Terpadu</p>
                </div>
            </div>

            <!-- Menu Utama Desktop -->
            <nav class="hidden lg:flex items-center gap-8 font-medium text-xs tracking-wide uppercase text-slate-600">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-teal-600 font-bold border-b-2 border-teal-500 pb-1' : 'hover:text-slate-900 transition' }}">Beranda</a>
                <a href="{{ route('profil') }}" class="{{ request()->routeIs('profil') ? 'text-teal-600 font-bold border-b-2 border-teal-500 pb-1' : 'hover:text-slate-900 transition' }}">Tentang Kami</a>
                <a href="{{ route('pendidikan') }}" class="{{ request()->routeIs('pendidikan') ? 'text-teal-600 font-bold border-b-2 border-teal-500 pb-1' : 'hover:text-slate-900 transition' }}">Program Studi</a>
                <a href="{{ route('berita') }}" class="{{ request()->routeIs('berita') ? 'text-teal-600 font-bold border-b-2 border-teal-500 pb-1' : 'hover:text-slate-900 transition' }}">Berita</a>
                <a href="{{ route('galeri') }}" class="{{ request()->routeIs('galeri') ? 'text-teal-600 font-bold border-b-2 border-teal-500 pb-1' : 'hover:text-slate-900 transition' }}">Galeri Media</a>
                <a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak') ? 'text-teal-600 font-bold border-b-2 border-teal-500 pb-1' : 'hover:text-slate-900 transition' }}">Kontak</a>
                
                @if($setting->feature_ppdb)
                <a href="{{ route('pendaftaran') }}" class="bg-slate-900 hover:bg-slate-800 text-cyan-400 px-5 py-2.5 rounded-xl font-bold transition shadow-sm border border-slate-700">
                    PPDB Online
                </a>
                @endif
            </nav>

            <!-- Mobile Menu Toggle Trigger -->
            <button id="btnModernToggle" class="lg:hidden text-slate-800 focus:outline-none p-1">
                <i class="fa-solid fa-bars text-xl"></i>
            </button>
        </header>
    </div>

    <!-- MOBILE MENU DRAWER OVERLAY (BARU) -->
    <div id="modernMobileOverlay" class="fixed inset-0 bg-slate-950/40 backdrop-blur-sm z-50 hidden transition-all duration-300">
        <div class="fixed top-4 right-4 bottom-4 w-68 bg-white rounded-2xl shadow-2xl flex flex-col justify-between border border-slate-200/60 overflow-hidden">
            <div>
                <div class="p-4 flex items-center justify-between border-b border-slate-100 bg-slate-50">
                    <span class="text-xs font-bold uppercase tracking-widest text-slate-900">Navigasi Sistem</span>
                    <button id="btnModernClose" class="text-slate-400 hover:text-red-500 p-1 transition"><i class="fa-solid fa-xmark text-base"></i></button>
                </div>
                <nav class="p-4 flex flex-col gap-1.5 font-medium text-xs tracking-wide uppercase text-slate-600">
                    <a href="{{ route('home') }}" class="p-3 rounded-xl transition {{ request()->routeIs('home') ? 'bg-teal-50 text-teal-700 font-bold' : 'hover:bg-slate-50' }}">Beranda</a>
                    <a href="{{ route('profil') }}" class="p-3 rounded-xl transition {{ request()->routeIs('profil') ? 'bg-teal-50 text-teal-700 font-bold' : 'hover:bg-slate-50' }}">Tentang Kami</a>
                    <a href="{{ route('pendidikan') }}" class="p-3 rounded-xl transition {{ request()->routeIs('pendidikan') ? 'bg-teal-50 text-teal-700 font-bold' : 'hover:bg-slate-50' }}">Program Studi</a>
                    <a href="{{ route('berita') }}" class="p-3 rounded-xl transition {{ request()->routeIs('berita') ? 'bg-teal-50 text-teal-700 font-bold' : 'hover:bg-slate-50' }}">Berita</a>
                    <a href="{{ route('galeri') }}" class="p-3 rounded-xl transition {{ request()->routeIs('galeri') ? 'bg-teal-50 text-teal-700 font-bold' : 'hover:bg-slate-50' }}">Galeri Media</a>
                    <a href="{{ route('kontak') }}" class="p-3 rounded-xl transition {{ request()->routeIs('kontak') ? 'bg-teal-50 text-teal-700 font-bold' : 'hover:bg-slate-50' }}">Kontak</a>
                </nav>
            </div>
            @if($setting->feature_ppdb)
            <div class="p-4 border-t border-slate-100 bg-slate-50">
                <a href="{{ route('pendaftaran') }}" class="w-full bg-slate-900 hover:bg-slate-800 text-cyan-400 py-3 rounded-xl font-bold text-xs tracking-wider uppercase text-center block shadow border border-slate-700">
                    Daftar PPDB Online
                </a>
            </div>
            @endif
        </div>
    </div>

    @yield('content')

    <!-- Footer Modern-Minimalist -->
    <footer class="bg-slate-950 text-slate-400 text-xs py-16 px-4 border-t border-slate-800">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-8 h-8 bg-gradient-to-tr from-slate-900 to-indigo-950 rounded-lg flex items-center justify-center text-cyan-400 font-bold">
                        <i class="fa-solid fa-layer-group text-sm"></i>
                    </div>
                    <span class="text-white font-extrabold text-sm tracking-tight">DARUSSALAM MODERN</span>
                </div>
                <p class="leading-relaxed text-slate-400 font-light">
                    Membentuk generasi muslim unggulan yang kompeten di bidang sains industri serta kokoh dalam tatanan nilai moral dan adab Islami.
                </p>
            </div>
            <div>
                <h4 class="text-white font-bold text-sm mb-4 tracking-tight">Navigasi Pintas</h4>
                <ul class="space-y-2.5 font-medium text-slate-400">
                    <li><a href="{{ route('profil') }}" class="hover:text-white transition flex items-center gap-1.5"><i class="fa-solid fa-angle-right text-[8px] text-teal-500"></i> Sejarah &amp; Visi Misi</a></li>
                    <li><a href="{{ route('pendidikan') }}" class="hover:text-white transition flex items-center gap-1.5"><i class="fa-solid fa-angle-right text-[8px] text-teal-500"></i> Struktur Agenda Harian</a></li>
                    <li><a href="{{ route('kontak') }}" class="hover:text-white transition flex items-center gap-1.5"><i class="fa-solid fa-angle-right text-[8px] text-teal-500"></i> Peta Lokasi Integrasi</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold text-sm mb-4 tracking-tight">Pusat Informasi</h4>
                <p class="leading-relaxed mb-3 font-light">
                    <i class="fa-solid fa-map-pin mr-2 text-teal-500"></i> Kantor Utama: {{ $profilSettings['kontak_alamat'] ?? 'Jl. Pendidikan No. 45, Tamalanrea, Kota Makassar, Sulawesi Selatan.' }}
                </p>
                <p class="leading-relaxed font-light">
                    <i class="fa-solid fa-headset mr-2 text-teal-500"></i> Layanan Informasi: {{ $profilSettings['kontak_telp_tu'] ?? '+62 812-3456-7890' }}
                </p>
            </div>
        </div>
        
        <div class="max-w-7xl mx-auto border-t border-slate-800 pt-6 text-center text-gray-600 flex flex-col sm:flex-row justify-between items-center gap-4">
            <p>&copy; 2026 Darussalam Modern Academy. Hak Cipta Dilindungi.</p>
            <p class="text-[10px] tracking-wider uppercase font-semibold">Infrastruktur Sistem oleh <a href="#" class="text-teal-500 hover:underline">lagingoding.com</a></p>
        </div>
    </footer>

    <!-- STICKY FLOATING ACTION WHATSAPP -->
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $profilSettings['kontak_telp_tu'] ?? '6281234567890') }}" target="_blank" class="fixed bottom-6 right-6 bg-white text-slate-900 w-14 h-14 rounded-2xl flex items-center justify-center text-xl shadow-2xl hover:bg-slate-100 transition z-50 border border-slate-200">
        <i class="fa-brands fa-whatsapp text-emerald-600"></i>
    </a>

    <!-- JAVASCRIPT FOR MOBILE DRAWER TOGGLE (BARU) -->
    <script>
        const btnOpen = document.getElementById('btnModernToggle');
        const btnClose = document.getElementById('btnModernClose');
        const overlay = document.getElementById('modernMobileOverlay');

        btnOpen.addEventListener('click', () => overlay.classList.remove('hidden'));
        btnClose.addEventListener('click', () => overlay.classList.add('hidden'));
        overlay.addEventListener('click', (e) => { if(e.target === overlay) overlay.classList.add('hidden'); });
    </script>
</body>
</html>