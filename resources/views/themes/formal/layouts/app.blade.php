<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesantren Darussalam - Modern & Berprestasi</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-800 antialiased font-sans">

    <!-- Top Bar (Informasi Kontak Singkat Dinamis) -->
    <div class="bg-emerald-900 text-white text-xs py-2.5 px-4 shadow-sm">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-2">
            <div class="flex items-center gap-4">
                <span><i class="fa-solid fa-phone mr-1 text-emerald-400"></i> {{ $profilSettings['kontak_telp_tu'] ?? '+62 812-3456-7890' }}</span>
                <span><i class="fa-solid fa-envelope mr-1 text-emerald-400"></i> {{ $profilSettings['kontak_email'] ?? 'sekretariat@darussalam.mahad.id' }}</span>
            </div>
            <div class="flex items-center gap-3">
                <a href="#" class="hover:text-emerald-300 transition"><i class="fa-brands fa-facebook"></i></a>
                <a href="#" class="hover:text-emerald-300 transition"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" class="hover:text-emerald-300 transition"><i class="fa-brands fa-youtube"></i></a>
            </div>
        </div>
    </div>

    <!-- Header Navigation -->
    <header class="bg-white border-b border-gray-100 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <!-- Logo & Identitas Pesantren -->
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-emerald-800 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-inner">
                    <i class="fa-solid fa-mosque"></i>
                </div>
                <div>
                    <h1 class="font-bold text-base md:text-lg text-emerald-900 leading-tight tracking-wide">PESANTREN DARUSSALAM</h1>
                    <p class="text-[10px] text-gray-500 font-medium tracking-widest uppercase">KOTA MAKASSAR</p>
                </div>
            </div>

            <!-- Menu Utama Desktop -->
            <nav class="hidden md:flex items-center gap-6 font-medium text-sm text-gray-600">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-emerald-700 font-semibold border-b-2 border-emerald-700 pb-1' : 'hover:text-emerald-700 transition' }}">Beranda</a>
                <a href="{{ route('profil') }}" class="{{ request()->routeIs('profil') ? 'text-emerald-700 font-semibold border-b-2 border-emerald-700 pb-1' : 'hover:text-emerald-700 transition' }}">Profil</a>
                <a href="{{ route('pendidikan') }}" class="{{ request()->routeIs('pendidikan') ? 'text-emerald-700 font-semibold border-b-2 border-emerald-700 pb-1' : 'hover:text-emerald-700 transition' }}">Pendidikan</a>
                <a href="{{ route('berita') }}" class="{{ request()->routeIs('berita') ? 'text-emerald-700 font-semibold border-b-2 border-emerald-700 pb-1' : 'hover:text-emerald-700 transition' }}">Berita</a>
                <a href="{{ route('galeri') }}" class="{{ request()->routeIs('galeri') ? 'text-emerald-700 font-semibold border-b-2 border-emerald-700 pb-1' : 'hover:text-emerald-700 transition' }}">Galeri</a>
                <a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak') ? 'text-emerald-700 font-semibold border-b-2 border-emerald-700 pb-1' : 'hover:text-emerald-700 transition' }}">Kontak</a>
                
                @if ($setting->feature_ppdb)
                <a href="{{ route('pendaftaran') }}" class="bg-emerald-700 hover:bg-emerald-800 text-white px-4 py-2 rounded font-semibold text-xs tracking-wider transition uppercase shadow">
                    Daftar PPDB
                </a>
                @endif
            </nav>

            <!-- Mobile Menu Toggle Trigger -->
            <button id="btnFormalToggle" class="md:hidden text-gray-600 focus:outline-none p-1">
                <i class="fa-solid fa-bars text-xl"></i>
            </button>
        </div>
    </header>

    <!-- MOBILE MENU DRAWER OVERLAY -->
    <div id="formalMobileOverlay" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 hidden transition-all duration-300">
        <div class="fixed top-0 right-0 bottom-0 w-64 bg-white shadow-xl flex flex-col justify-between border-l border-slate-100">
            <div>
                <div class="p-4 flex items-center justify-between border-b border-slate-100 bg-slate-50">
                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-950">Menu Navigasi</span>
                    <button id="btnFormalClose" class="text-slate-400 hover:text-red-500 transition"><i class="fa-solid fa-xmark text-lg"></i></button>
                </div>
                <nav class="p-4 flex flex-col gap-2 font-medium text-sm text-slate-700">
                    <a href="{{ route('home') }}" class="p-2.5 rounded-lg transition {{ request()->routeIs('home') ? 'bg-emerald-50 text-emerald-800 font-bold' : 'hover:bg-slate-50' }}">Beranda</a>
                    <a href="{{ route('profil') }}" class="p-2.5 rounded-lg transition {{ request()->routeIs('profil') ? 'bg-emerald-50 text-emerald-800 font-bold' : 'hover:bg-slate-50' }}">Profil</a>
                    <a href="{{ route('pendidikan') }}" class="p-2.5 rounded-lg transition {{ request()->routeIs('pendidikan') ? 'bg-emerald-50 text-emerald-800 font-bold' : 'hover:bg-slate-50' }}">Pendidikan</a>
                    <a href="{{ route('berita') }}" class="p-2.5 rounded-lg transition {{ request()->routeIs('berita') ? 'bg-emerald-50 text-emerald-800 font-bold' : 'hover:bg-slate-50' }}">Berita</a>
                    <a href="{{ route('galeri') }}" class="p-2.5 rounded-lg transition {{ request()->routeIs('galeri') ? 'bg-emerald-50 text-emerald-800 font-bold' : 'hover:bg-slate-50' }}">Galeri</a>
                    <a href="{{ route('kontak') }}" class="p-2.5 rounded-lg transition {{ request()->routeIs('kontak') ? 'bg-emerald-50 text-emerald-800 font-bold' : 'hover:bg-slate-50' }}">Kontak</a>
                </nav>
            </div>
            @if ($setting->feature_ppdb)
            <div class="p-4 border-t border-slate-100 bg-slate-50">
                <a href="{{ route('pendaftaran') }}" class="w-full bg-emerald-700 hover:bg-emerald-800 text-white py-3 rounded-lg font-bold text-xs tracking-wider transition uppercase text-center block shadow">
                    Pendaftaran PPDB Online
                </a>
            </div>
            @endif
        </div>
    </div>

    @yield('content')

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 text-xs py-12 px-4 border-t-4 border-emerald-800">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            <div>
                <h4 class="text-white font-bold text-sm mb-4 tracking-wider uppercase">Tentang Kami</h4>
                <p class="leading-relaxed mb-4 text-gray-400 font-light">
                    Pesantren Darussalam berdedikasi tinggi menyelenggarakan sistem pengajaran Islam transparan dan bermutu tinggi di wilayah Indonesia Timur.
                </p>
            </div>
            <div>
                <h4 class="text-white font-bold text-sm mb-4 tracking-wider uppercase">Tautan Cepat</h4>
                <ul class="space-y-2 font-medium">
                    <li><a href="{{ route('profil') }}" class="hover:text-white transition">Struktur Pengurus &amp; Profil</a></li>
                    <li><a href="{{ route('pendidikan') }}" class="hover:text-white transition">Kurikulum Madrasah</a></li>
                    <li><a href="{{ route('kontak') }}" class="hover:text-white transition">Peta Lokasi Google Maps</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold text-sm mb-4 tracking-wider uppercase">Sekretariat</h4>
                <p class="leading-relaxed mb-2 font-light">
                    <i class="fa-solid fa-location-dot mr-1.5 text-emerald-500"></i> {{ $profilSettings['kontak_alamat'] ?? 'Jl. Pendidikan No. 45, Kecamatan Tamalanrea, Kota Makassar, Sulawesi Selatan.' }}
                </p>
            </div>
        </div>
        <div class="max-w-7xl mx-auto border-t border-gray-800 pt-6 text-center text-gray-500 flex flex-col sm:flex-row justify-between items-center gap-4">
            <p>&copy; 2026 Pesantren Darussalam. All Rights Reserved.</p>
            <p class="text-[10px]">Powered by <a href="#" class="text-emerald-600 font-semibold hover:underline">lagingoding.com</a></p>
        </div>
    </footer>

    <!-- STICKY WHATSAPP BUTTON -->
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $profilSettings['kontak_telp_tu'] ?? '6281234567890') }}" target="_blank" class="fixed bottom-6 right-6 bg-green-500 text-white w-14 h-14 rounded-full flex items-center justify-center text-2xl shadow-xl hover:bg-green-600 transition z-50 animate-bounce">
        <i class="fa-brands fa-whatsapp"></i>
    </a>

    <!-- JAVASCRIPT FOR MOBILE MENU TOGGLE -->
    <script>
        const btnToggle = document.getElementById('btnFormalToggle');
        const btnClose = document.getElementById('btnFormalClose');
        const overlay = document.getElementById('formalMobileOverlay');

        btnToggle.addEventListener('click', () => overlay.classList.remove('hidden'));
        btnClose.addEventListener('click', () => overlay.classList.add('hidden'));
        overlay.addEventListener('click', (e) => { if(e.target === overlay) overlay.classList.add('hidden'); });
    </script>
</body>
</html>