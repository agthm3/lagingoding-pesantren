<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Utama - Sistem Manajemen Pesantren</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#f8fafc] text-slate-800 antialiased font-sans flex min-h-screen">

    <!-- 1. SIDEBAR NAVIGATION (Panel Navigasi Samping) -->
    <aside class="w-66 bg-white text-slate-600 shrink-0 hidden md:flex flex-col justify-between border-r border-slate-200/80 shadow-sm">
        <div>
            <!-- Header Brand -->
            <div class="px-6 py-5 flex items-center gap-3 border-b border-slate-100 bg-slate-50/50">
                <div class="w-9 h-9 bg-slate-900 text-white rounded-xl flex items-center justify-center font-bold shadow-sm">
                    <i class="fa-solid fa-cube text-sm"></i>
                </div>
                <div>
                    <h2 class="text-slate-900 font-black text-sm tracking-tight leading-none">MA'HAD CORE</h2>
                    <p class="text-[9px] text-indigo-600 font-bold tracking-widest uppercase mt-1">Sistem Manajemen</p>
                </div>
            </div>

            <!-- Menu Navigasi (Tab Ringkasan Aktif) -->
            <nav class="px-4 py-6 space-y-1 text-xs font-bold">
                <span class="px-3 text-[10px] text-slate-400 uppercase tracking-widest block mb-2">Ringkasan</span>
                <!-- Menu ini yang sedang aktif -->
                <a href="{{ route("dashboard.index") }}" class="flex items-center gap-3 bg-indigo-50 text-indigo-950 px-3 py-2.5 rounded-xl transition border border-indigo-100">
                    <i class="fa-solid fa-chart-pie text-sm text-indigo-600"></i> Ringkasan Dasbor
                </a>

                <span class="px-3 text-[10px] text-slate-400 uppercase tracking-widest block pt-5 mb-2">Operasional Pondok</span>
                <a href="{{ route("dashboard.pendaftaran.index") }}" class="flex items-center gap-3 hover:bg-slate-50 text-slate-700 px-3 py-2.5 rounded-xl transition">
                    <i class="fa-solid fa-graduation-cap text-sm text-slate-400"></i> Pendaftar PPDB
                </a>
                <a href="{{ route('dashboard.berita.index') }}" class="flex items-center gap-3 hover:bg-slate-50 text-slate-700 px-3 py-2.5 rounded-xl transition">
                    <i class="fa-regular fa-newspaper text-sm text-slate-400"></i> Berita & Kegiatan
                </a>
                <a href="{{ route('dashboard.galeri.index') }}" class="flex items-center gap-3 hover:bg-slate-50 text-slate-700 px-3 py-2.5 rounded-xl transition">
                    <i class="fa-regular fa-images text-sm text-slate-400"></i> Galeri Media
                </a>
                <a href="{{ route('dashboard.sarana.index') }}" class="flex items-center gap-3 hover:bg-slate-50 text-slate-700 px-3 py-2.5 rounded-xl transition">
                    <i class="fa-regular fa-building text-sm text-slate-400"></i> Sarana Fasilitas
                </a>
                <a href="{{ route('dashboard.prestasi.index') }}" class="flex items-center gap-3 hover:bg-slate-50 text-slate-700 px-3 py-2.5 rounded-xl transition">
                    <i class="fa-regular fa-building text-sm text-slate-400"></i> Prestasi
                </a>

                <!-- MENU KHUSUS KONFIGURASI SUPERADMIN -->
                <span class="px-3 text-[10px] text-indigo-600 uppercase tracking-widest block pt-6 mb-2 border-t border-slate-100 mt-4">Pusat Superadmin</span>
                <a href="{{ route('dashboard.pengaturan.index') }}" class="flex items-center gap-3 hover:bg-slate-50 text-slate-700 px-3 py-2.5 rounded-xl transition">
                    <i class="fa-solid fa-palette text-sm text-slate-400"></i> Pengaturan Tema & Fitur
                </a>
                                <!-- Menu Kustom Baru: Kelola User Aktif -->
                <a href="{{ route('dashboard.kelolaUser.index') }}" class="flex items-center gap-3 bg-indigo-50 text-indigo-950 px-3 py-2.5 rounded-xl transition border border-indigo-100">
                    <i class="fa-solid fa-users-gear text-sm text-indigo-600"></i> Kelola Pengguna & Peran
                </a>

            </nav>
        </div>

        <!-- Akun Pengguna Aktif di Bagian Bawah -->
        <div class="p-4 border-t border-slate-100 bg-slate-50/40 flex items-center justify-between text-xs font-bold">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-full bg-slate-900 text-white flex items-center justify-center text-xs">AD</div>
                <div>
                    <h5 class="text-slate-900 leading-none font-black">Andi Admin</h5>
                    <span class="text-[9px] text-slate-400 block mt-0.5">Administrator</span>
                </div>
            </div>
            <a href="#" class="text-slate-400 hover:text-red-500 p-1 transition"><i class="fa-solid fa-power-off text-sm"></i></a>
        </div>
    </aside>

    @yield('content')

</body>
</html>