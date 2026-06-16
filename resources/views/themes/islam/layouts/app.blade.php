<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesantren Darussalam - Menjaga Tradisi, Menggapai Prestasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#fcfbf7] text-gray-800 antialiased font-sans">

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

    <header class="bg-white sticky top-0 z-50 shadow-md border-b-4 border-emerald-800">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            
            <div class="flex items-center gap-3">
                <div class="w-14 h-14 bg-emerald-900 rounded-full flex items-center justify-center text-amber-400 font-bold text-2xl shadow-md border-2 border-amber-400/60">
                    <i class="fa-solid fa-mosque"></i>
                </div>
                <div>
                    <h1 class="font-serif font-bold text-sm md:text-xl text-emerald-900 leading-tight tracking-wide">PONDOK PESANTREN DARUSSALAM</h1>
                    <p class="text-[9px] md:text-[10px] text-amber-600 font-bold tracking-widest uppercase flex items-center gap-1.5">
                        <i class="fa-solid fa-star text-[8px]"></i> Lembaga Pendidikan Salafiyah Syafi'iyah <i class="fa-solid fa-star text-[8px]"></i>
                    </p>
                </div>
            </div>

            <!-- DESKTOP NAVIGATION -->
            <nav class="hidden lg:flex items-center gap-6 font-semibold text-sm text-emerald-950">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-amber-600 border-b-2 border-amber-500 pb-1' : 'hover:text-amber-600 transition' }}">Beranda</a>
                <a href="{{ route('profil') }}" class="{{ request()->routeIs('profil') ? 'text-amber-600 border-b-2 border-amber-500 pb-1' : 'hover:text-amber-600 transition' }}">Profil Ma'had</a>
                <a href="{{ route('pendidikan') }}" class="{{ request()->routeIs('pendidikan') ? 'text-amber-600 border-b-2 border-amber-500 pb-1' : 'hover:text-amber-600 transition' }}">Madrasah</a>
                <a href="{{ route('berita') }}" class="{{ request()->routeIs('berita') ? 'text-amber-600 border-b-2 border-amber-500 pb-1' : 'hover:text-amber-600 transition' }}">Kabar Kegiatan</a>
                <a href="{{ route('galeri') }}" class="{{ request()->routeIs('galeri') ? 'text-amber-600 border-b-2 border-amber-500 pb-1' : 'hover:text-amber-600 transition' }}">Galeri Media</a>
                <a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak') ? 'text-amber-600 border-b-2 border-amber-500 pb-1' : 'hover:text-amber-600 transition' }}">Hubungi</a>
                
                @if ($setting->feature_ppdb)
                <a href="{{ route('pendaftaran') }}" class="bg-amber-500 hover:bg-amber-600 text-emerald-950 px-5 py-2 rounded-xl font-bold text-xs tracking-wider transition uppercase shadow border border-amber-400">
                    <i class="fa-solid fa-graduation-cap mr-1"></i> PPDB Online
                </a>
                @endif
            </nav>

            <!-- TRIGGER BUTTON MOBILE (ID Ditambahkan Untuk JS Klik) -->
            <button id="btnMobileToggle" class="lg:hidden text-emerald-900 focus:outline-none p-1">
                <i class="fa-solid fa-bars-staggered text-2xl"></i>
            </button>
        </div>
    </header>

    <!-- CONTAINER DRAWER MENU MOBILE (BARU) -->
    <div id="mobileMenuOverlay" class="fixed inset-0 bg-emerald-950/40 backdrop-blur-sm z-50 hidden transition-all duration-300">
        <div class="fixed top-0 right-0 bottom-0 w-72 bg-white shadow-2xl flex flex-col justify-between border-l border-emerald-800/10">
            <div>
                <!-- Header Drawer -->
                <div class="p-4 flex items-center justify-between border-b border-gray-100 bg-slate-50">
                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-900 flex items-center gap-2">
                        <i class="fa-solid fa-mosque"></i> Navigasi Portal
                    </span>
                    <button id="btnMobileClose" class="text-gray-400 hover:text-red-500 text-lg p-1 transition">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <!-- Link List Drawer -->
                <nav class="p-4 flex flex-col gap-3 font-semibold text-sm text-emerald-950">
                    <a href="{{ route('home') }}" class="p-2.5 rounded-xl transition {{ request()->routeIs('home') ? 'bg-emerald-50 text-emerald-800 font-bold' : 'hover:bg-slate-50' }}">Beranda</a>
                    <a href="{{ route('profil') }}" class="p-2.5 rounded-xl transition {{ request()->routeIs('profil') ? 'bg-emerald-50 text-emerald-800 font-bold' : 'hover:bg-slate-50' }}">Profil Ma'had</a>
                    <a href="{{ route('pendidikan') }}" class="p-2.5 rounded-xl transition {{ request()->routeIs('pendidikan') ? 'bg-emerald-50 text-emerald-800 font-bold' : 'hover:bg-slate-50' }}">Madrasah</a>
                    <a href="{{ route('berita') }}" class="p-2.5 rounded-xl transition {{ request()->routeIs('berita') ? 'bg-emerald-50 text-emerald-800 font-bold' : 'hover:bg-slate-50' }}">Kabar Kegiatan</a>
                    <a href="{{ route('galeri') }}" class="p-2.5 rounded-xl transition {{ request()->routeIs('galeri') ? 'bg-emerald-50 text-emerald-800 font-bold' : 'hover:bg-slate-50' }}">Galeri Media</a>
                    <a href="{{ route('kontak') }}" class="p-2.5 rounded-xl transition {{ request()->routeIs('kontak') ? 'bg-emerald-50 text-emerald-800 font-bold' : 'hover:bg-slate-50' }}">Hubungi</a>
                </nav>
            </div>

            <!-- Footer Action di Drawer -->
            @if ($setting->feature_ppdb)
            <div class="p-4 border-t border-gray-100 bg-slate-50">
                <a href="{{ route('pendaftaran') }}" class="w-full bg-amber-500 hover:bg-amber-600 text-emerald-950 py-3 rounded-xl font-bold text-xs tracking-wider transition uppercase shadow block text-center border border-amber-400">
                    <i class="fa-solid fa-graduation-cap mr-1"></i> PPDB Online Resmi
                </a>
            </div>
            @endif
        </div>
    </div>

    @yield('content')

    <footer class="bg-gradient-to-b from-emerald-950 to-[#03140d] text-gray-400 text-xs py-16 px-4 border-t-4 border-amber-500">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-8 h-8 bg-amber-500 rounded-full flex items-center justify-center text-emerald-950 text-sm font-bold">
                        <i class="fa-solid fa-mosque"></i>
                    </div>
                    <h4 class="text-white font-serif font-bold text-sm tracking-wider uppercase">Darussalam Ma'had</h4>
                </div>
                <p class="leading-relaxed text-gray-400 font-light">
                    Membina akhlak mulia dan menegakkan panji-panji keilmuan syariat Islam yang luhur demi kemaslahatan umat dunia dan akhirat.
                </p>
            </div>
            <div>
                <h4 class="text-amber-400 font-serif font-bold text-sm mb-4 tracking-wider uppercase">Menu Pintas</h4>
                <ul class="space-y-2.5 font-medium">
                    <li><a href="#" class="hover:text-white hover:underline transition flex items-center gap-1.5"><i class="fa-solid fa-chevron-right text-[8px] text-amber-500"></i> Sanad Pengurus</a></li>
                    <li><a href="#" class="hover:text-white hover:underline transition flex items-center gap-1.5"><i class="fa-solid fa-chevron-right text-[8px] text-amber-500"></i> Aturan Kedisiplinan</a></li>
                    <li><a href="#" class="hover:text-white hover:underline transition flex items-center gap-1.5"><i class="fa-solid fa-chevron-right text-[8px] text-amber-500"></i> Lokasi Google Maps</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-amber-400 font-serif font-bold text-sm mb-4 tracking-wider uppercase">Biro Sekretariat</h4>
                <p class="leading-relaxed mb-3 font-light">
                    <i class="fa-solid fa-map-location-dot mr-2 text-amber-500"></i> Kampus Utama: Jl. Pendidikan No. 45, Tamalanrea, Kota Makassar, Sulawesi Selatan.
                </p>
                <p class="leading-relaxed font-light">
                    <i class="fa-solid fa-phone mr-2 text-amber-500"></i> Telp/WA: +62 812-3456-7890
                </p>
            </div>
        </div>
        
        <div class="max-w-7xl mx-auto border-t border-emerald-900/60 pt-6 text-center text-gray-500 flex flex-col sm:flex-row justify-between items-center gap-4">
            <p>&copy; 1447 - 2026 PP. Darussalam Makassar. Hak Cipta Dilindungi Undang-Undang.</p>
            <p class="text-[10px] tracking-widest uppercase">Khidmat Media oleh <a href="#" class="text-amber-500 font-bold hover:underline">lagingoding.com</a></p>
        </div>
    </footer>

    <a href="https://wa.me/6281234567890" target="_blank" class="fixed bottom-6 right-6 bg-emerald-800 text-amber-300 w-14 h-14 rounded-full flex items-center justify-center text-2xl shadow-2xl hover:bg-emerald-700 transition z-50 border border-amber-400">
        <i class="fa-brands fa-whatsapp"></i>
    </a>

    <!-- SCRIPTS JAVASCRIPT UNTUK TOGGLE MENU SELULER (BARU) -->
    <script>
        const btnOpen = document.getElementById('btnMobileToggle');
        const btnClose = document.getElementById('btnMobileClose');
        const overlayMenu = document.getElementById('mobileMenuOverlay');

        // Fungsi Memunculkan Drawer Menu
        btnOpen.addEventListener('click', () => {
            overlayMenu.classList.remove('hidden');
        });

        // Fungsi Menyembunyikan Drawer Menu via Tombol X
        btnClose.addEventListener('click', () => {
            overlayMenu.classList.add('hidden');
        });

        // Fungsi Menyembunyikan Drawer Menu jika area luar diklik
        overlayMenu.addEventListener('click', (e) => {
            if (e.target === overlayMenu) {
                overlayMenu.classList.add('hidden');
            }
        });
    </script>

</body>
</html>