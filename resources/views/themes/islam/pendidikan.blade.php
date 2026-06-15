@extends('themes.islam.layouts.app')

@section('content')
    <!-- Page Header -->
    <section class="bg-emerald-950 text-white py-12 px-4 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('https://images.unsplash.com/photo-1590075865003-e48277adc558')] bg-cover bg-center mix-blend-overlay"></div>
        <div class="relative max-w-7xl mx-auto text-center md:text-left flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold tracking-tight">Program Pendidikan</h2>
                <p class="text-emerald-300 text-xs mt-1">Sistem kurikulum, jenjang lembaga, dan aktivitas harian santri</p>
            </div>
            <div class="text-xs text-emerald-400 bg-emerald-900/50 px-4 py-2 rounded border border-emerald-800/60">
                <!-- Perbaikan Link Menggunakan Route Laravel -->
                <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a> 
                <span class="mx-2 text-gray-500">/</span> 
                <span class="text-white">Pendidikan</span>
            </div>
        </div>
    </section>

    <!-- Jenjang Pendidikan (Dinamis / Berulang) -->
    <section class="py-16 px-4 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 block mb-1">Lembaga Formal & Non-Formal</span>
                <h3 class="text-2xl font-bold text-gray-900 tracking-tight">Jenjang Pendidikan yang Dikelola</h3>
                <div class="w-12 h-1 bg-emerald-600 mx-auto mt-3"></div>
            </div>

            <!-- Grid Jenjang -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Jenjang 1 -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-100 hover:border-emerald-600/30 hover:shadow-md transition flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 bg-emerald-100 text-emerald-800 rounded-lg flex items-center justify-center text-xl font-bold mb-4">
                            <i class="fa-solid fa-book-open"></i>
                        </div>
                        <h4 class="font-bold text-gray-900 text-lg mb-2">Madrasah Tsanawiyah (MTs)</h4>
                        <p class="text-xs text-emerald-700 font-medium uppercase tracking-wider mb-3">Akreditasi A • Masa Studi 3 Tahun</p>
                        <p class="text-gray-600 text-xs leading-relaxed mb-4">
                            Pendidikan setingkat SMP yang mengintegrasikan kurikulum dasar Kementerian Agama dengan pendalaman kitab khazanah Islam klasik tingkat dasar serta bimbingan ibadah harian.
                        </p>
                    </div>
                    <div class="border-t border-gray-200/60 pt-4 mt-2">
                        <span class="text-[11px] font-semibold text-gray-500 uppercase block mb-1">Fokus Utama:</span>
                        <div class="flex flex-wrap gap-1.5 text-[10px] font-medium text-gray-600">
                            <span class="bg-gray-200/70 px-2 py-0.5 rounded">Fathul Qorib</span>
                            <span class="bg-gray-200/70 px-2 py-0.5 rounded">Nahwu Sharaf Dasar</span>
                            <span class="bg-gray-200/70 px-2 py-0.5 rounded">Imriti</span>
                        </div>
                    </div>
                </div>

                <!-- Jenjang 2 -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-100 hover:border-emerald-600/30 hover:shadow-md transition flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 bg-emerald-100 text-emerald-800 rounded-lg flex items-center justify-center text-xl font-bold mb-4">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </div>
                        <h4 class="font-bold text-gray-900 text-lg mb-2">Madrasah Aliyah (MA)</h4>
                        <p class="text-xs text-emerald-700 font-medium uppercase tracking-wider mb-3">Akreditasi A • Jurusan Keagamaan / IPA</p>
                        <p class="text-gray-600 text-xs leading-relaxed mb-4">
                            Pendidikan setingkat SMA yang mempersiapkan santri untuk melanjutkan ke perguruan tinggi nasional maupun internasional (Timur Tengah) dengan penguasaan bahasa Arab aktif.
                        </p>
                    </div>
                    <div class="border-t border-gray-200/60 pt-4 mt-2">
                        <span class="text-[11px] font-semibold text-gray-500 uppercase block mb-1">Fokus Utama:</span>
                        <div class="flex flex-wrap gap-1.5 text-[10px] font-medium text-gray-600">
                            <span class="bg-gray-200/70 px-2 py-0.5 rounded">Alfiyah Ibnu Malik</span>
                            <span class="bg-gray-200/70 px-2 py-0.5 rounded">Balaghah</span>
                            <span class="bg-gray-200/70 px-2 py-0.5 rounded">B. Arab Aktif</span>
                        </div>
                    </div>
                </div>

                <!-- Jenjang 3 -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-100 hover:border-emerald-600/30 hover:shadow-md transition flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 bg-emerald-100 text-emerald-800 rounded-lg flex items-center justify-center text-xl font-bold mb-4">
                            <i class="fa-solid fa-heart-pulse"></i>
                        </div>
                        <h4 class="font-bold text-gray-900 text-lg mb-2">Tahfidzul Qur'an</h4>
                        <p class="text-xs text-emerald-700 font-medium uppercase tracking-wider mb-3">Program Unggulan • Target 30 Juz</p>
                        <p class="text-gray-600 text-xs leading-relaxed mb-4">
                            Program khusus berfokus pada hafalan Al-Qur'an dengan metode talaqqi langsung di bawah bimbingan para huffadz bersanad, dilengkapi dengan ilmu tajwid dan ghorib.
                        </p>
                    </div>
                    <div class="border-t border-gray-200/60 pt-4 mt-2">
                        <span class="text-[11px] font-semibold text-gray-500 uppercase block mb-1">Fokus Utama:</span>
                        <div class="flex flex-wrap gap-1.5 text-[10px] font-medium text-gray-600">
                            <span class="bg-gray-200/70 px-2 py-0.5 rounded">Ziyadah (Setoran)</span>
                            <span class="bg-gray-200/70 px-2 py-0.5 rounded">Murajaah Kuat</span>
                            <span class="bg-gray-200/70 px-2 py-0.5 rounded">Matan Jazariyah</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- INTEGRASI SAKLAR FITUR: DOWNLOAD CENTE BROSUR KURIKULUM --}}
            @if($setting->feature_download)
            <div class="mt-12 p-6 bg-emerald-50 rounded-xl border border-emerald-100 flex flex-col sm:flex-row justify-between items-center gap-4 max-w-3xl mx-auto">
                <div class="flex items-center gap-4 text-center sm:text-left flex-col sm:flex-row">
                    <div class="text-2xl text-emerald-800"><i class="fa-solid fa-file-pdf"></i></div>
                    <div>
                        <h5 class="font-bold text-sm text-gray-900">Unduh Dokumen Kurikulum Lengkap</h5>
                        <p class="text-xs text-gray-500">Dapatkan rincian silabus pembelajaran dan daftar kitab pegangan santri.</p>
                    </div>
                </div>
                <a href="#" class="bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-semibold px-4 py-2.5 rounded transition whitespace-nowrap shadow-sm">
                    <i class="fa-solid fa-download mr-1"></i> Unduh Brosur (.PDF)
                </a>
            </div>
            @endif
        </div>
    </section>

    <!-- Jadwal Aktivitas Harian Santri -->
    <section class="py-16 px-4 bg-gray-50 border-t border-gray-100">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-10">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 block mb-1">Agenda Rutin</span>
                <h3 class="text-2xl font-bold text-gray-900 tracking-tight">Aktivitas Harian Santri</h3>
                <p class="text-xs text-gray-500 mt-1 max-w-md mx-auto">Gambaran pola kegiatan kedisiplinan santri mukim dari bangun tidur hingga istirahat malam kembali</p>
                <div class="w-12 h-1 bg-emerald-600 mx-auto mt-3"></div>
            </div>

            <!-- Timeline Table-Style Layout -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="divide-y divide-gray-100">
                    <!-- Item 1 -->
                    <div class="p-4 sm:grid sm:grid-cols-4 sm:gap-4 items-center">
                        <div class="font-bold text-emerald-800 text-sm mb-1 sm:mb-0"><i class="fa-regular fa-clock mr-1.5 text-emerald-600"></i> 04.00 - 05.15</div>
                        <div class="sm:col-span-3">
                            <h5 class="font-bold text-gray-800 text-sm">Shalat Subuh Berjamaah & Khitabah</h5>
                            <p class="text-xs text-gray-500 mt-0.5">Dilanjutkan dengan membaca wirid pagi dan setoran hafalan Al-Qur'an / bait muhafadhah.</p>
                        </div>
                    </div>
                    <!-- Item 2 -->
                    <div class="p-4 sm:grid sm:grid-cols-4 sm:gap-4 items-center">
                        <div class="font-bold text-emerald-800 text-sm mb-1 sm:mb-0"><i class="fa-regular fa-clock mr-1.5 text-emerald-600"></i> 07.15 - 12.00</div>
                        <div class="sm:col-span-3">
                            <h5 class="font-bold text-gray-800 text-sm">KBM Madrasah Formal</h5>
                            <p class="text-xs text-gray-500 mt-0.5">Pembelajaran kurikulum nasional (Kemenag/Kemendikbud) di ruang kelas masing-masing jenjang.</p>
                        </div>
                    </div>
                    <!-- Item 3 -->
                    <div class="p-4 sm:grid sm:grid-cols-4 sm:gap-4 items-center">
                        <div class="font-bold text-emerald-800 text-sm mb-1 sm:mb-0"><i class="fa-regular fa-clock mr-1.5 text-emerald-600"></i> 14.00 - 15.15</div>
                        <div class="sm:col-span-3">
                            <h5 class="font-bold text-gray-800 text-sm">Kajian Kitab Kuning (Madrasah Diniyah)</h5>
                            <p class="text-xs text-gray-500 mt-0.5">Pendalaman materi fiqih, nahwu, sharaf, aqidah, dan akhlak menggunakan metode bandongan/sorogan.</p>
                        </div>
                    </div>
                    <!-- Item 4 -->
                    <div class="p-4 sm:grid sm:grid-cols-4 sm:gap-4 items-center">
                        <div class="font-bold text-emerald-800 text-sm mb-1 sm:mb-0"><i class="fa-regular fa-clock mr-1.5 text-emerald-600"></i> 18.30 - 20.00</div>
                        <div class="sm:col-span-3">
                            <h5 class="font-bold text-gray-800 text-sm">Maghrib Mengaji & Isya Berjamaah</h5>
                            <p class="text-xs text-gray-500 mt-0.5">Pendalaman hafalan juz individu dipandu langsung oleh ustadz pembimbing halaqah.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection