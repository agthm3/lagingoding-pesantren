@extends('themes.modern.layouts.app')

@section('content')
    
    <!-- Page Header -->
    <section class="max-w-7xl mx-auto px-4 pt-12">
        <div class="bg-slate-900 text-white rounded-3xl py-12 px-8 md:px-16 relative overflow-hidden shadow-inner">
            <div class="absolute -right-10 -bottom-10 w-60 h-60 bg-cyan-500/10 rounded-full blur-3xl"></div>
            <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <span class="text-xs font-bold text-cyan-400 tracking-widest uppercase block mb-1">Kurikulum Akademik</span>
                    <h2 class="text-2xl md:text-4xl font-black tracking-tight">Program &amp; Jenjang Studi</h2>
                </div>
                <div class="text-xs text-slate-400 bg-white/5 px-4 py-2 rounded-xl border border-white/10 backdrop-blur-sm">
                    <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a> 
                    <span class="mx-2">/</span> 
                    <span class="text-teal-400 font-semibold">Program Studi</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Daftar Program Pendidikan -->
    <section class="max-w-7xl mx-auto px-4 py-16">
        <div class="text-center mb-12">
            <span class="text-[10px] font-bold uppercase tracking-widest text-teal-600 block mb-1">Akselerasi Kompetensi</span>
            <h3 class="text-2xl font-black text-slate-900 tracking-tight">Pilihan Jenjang Pendidikan</h3>
            <div class="w-8 h-1 bg-teal-500 mx-auto mt-3 rounded-full"></div>
        </div>

        <!-- Grid Program Pendidikan Dinamis -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- Program 1: MTs -->
            <div class="bg-white border border-slate-200 rounded-3xl p-6 hover:border-slate-300 hover:shadow-xl transition duration-300 flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 bg-slate-100 text-slate-900 rounded-2xl flex items-center justify-center text-xl font-bold mb-5 border border-slate-200/60 shadow-sm">
                        <i class="fa-solid fa-code"></i>
                    </div>
                    <h4 class="font-extrabold text-slate-900 text-lg mb-1">Madrasah Tsanawiyah (MTs)</h4>
                    <p class="text-[10px] text-teal-600 font-bold uppercase tracking-wider mb-4">Masa Studi 3 Tahun • Akreditasi A</p>
                    <p class="text-slate-500 text-xs leading-relaxed font-light mb-6">
                        {{ $pendidikanSettings['pendidikan_mts'] ?? "Pendidikan setingkat SMP yang memadukan kurikulum dasar Kementerian Agama dengan pengenalan logika komputasi, dasar pemrograman komputer, dan penguatan setoran hafalan Al-Qur'an harian." }}
                    </p>
                </div>
                <div class="border-t border-slate-100 pt-4">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-2">Fokus Keahlian:</span>
                    <div class="flex flex-wrap gap-1.5 text-[10px] font-medium text-slate-600">
                        <span class="bg-slate-100 px-2 py-0.5 rounded-md border border-slate-200/40">Logika Dasprog</span>
                        <span class="bg-slate-100 px-2 py-0.5 rounded-md border border-slate-200/40">Fathul Qorib</span>
                        <span class="bg-slate-100 px-2 py-0.5 rounded-md border border-slate-200/40">Sains Terpadu</span>
                    </div>
                </div>
            </div>

            <!-- Program 2: MA -->
            <div class="bg-white border border-slate-200 rounded-3xl p-6 hover:border-slate-300 hover:shadow-xl transition duration-300 flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 bg-slate-100 text-slate-900 rounded-2xl flex items-center justify-center text-xl font-bold mb-5 border border-slate-200/60 shadow-sm">
                        <i class="fa-solid fa-microchip"></i>
                    </div>
                    <h4 class="font-extrabold text-slate-900 text-lg mb-1">Madrasah Aliyah (MA)</h4>
                    <p class="text-[10px] text-teal-600 font-bold uppercase tracking-wider mb-4">Sains &amp; Keagamaan • Akreditasi A</p>
                    <p class="text-slate-500 text-xs leading-relaxed font-light mb-6">
                        {{ $pendidikanSettings['pendidikan_ma'] ?? 'Pendidikan setingkat SMA dengan peminatan sains digital. Santri dibekali kompetensi rekayasa perangkat lunak (RPL), kecerdasan buatan dasar, serta kemahiran aktif debat dua bahasa internasional.' }}
                    </p>
                </div>
                <div class="border-t border-slate-100 pt-4">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-2">Fokus Keahlian:</span>
                    <div class="flex flex-wrap gap-1.5 text-[10px] font-medium text-slate-600">
                        <span class="bg-slate-100 px-2 py-0.5 rounded-md border border-slate-200/40">IoT &amp; Rekayasa</span>
                        <span class="bg-slate-100 px-2 py-0.5 rounded-md border border-slate-200/40">B. Inggris Aktif</span>
                        <span class="bg-slate-100 px-2 py-0.5 rounded-md border border-slate-200/40">Ushul Fiqih</span>
                    </div>
                </div>
            </div>

            <!-- Program 3: Tahfidz -->
            <div class="bg-white border border-slate-200 rounded-3xl p-6 hover:border-slate-300 hover:shadow-xl transition duration-300 flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 bg-slate-100 text-slate-900 rounded-2xl flex items-center justify-center text-xl font-bold mb-5 border border-slate-200/60 shadow-sm">
                        <i class="fa-solid fa-server"></i>
                    </div>
                    <h4 class="font-extrabold text-slate-900 text-lg mb-1">Inkubator Tahfidz Digital</h4>
                    <p class="text-[10px] text-teal-600 font-bold uppercase tracking-wider mb-4">Program Utama • Target 30 Juz</p>
                    <p class="text-slate-500 text-xs leading-relaxed font-light mb-6">
                        {{ $pendidikanSettings['pendidikan_tahfidz'] ?? "Program akselerasi hafalan Al-Qur'an mutqin yang dikombinasikan dengan pelatihan administrasi basis data server, multimedia dakwah, dan sistem kelola data jaringan sehat." }}
                    </p>
                </div>
                <div class="border-t border-slate-100 pt-4">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-2">Fokus Keahlian:</span>
                    <div class="flex flex-wrap gap-1.5 text-[10px] font-medium text-slate-600">
                        <span class="bg-slate-100 px-2 py-0.5 rounded-md border border-slate-200/40">Tahfidz Mutqin</span>
                        <span class="bg-slate-100 px-2 py-0.5 rounded-md border border-slate-200/40">Basis Data</span>
                        <span class="bg-slate-100 px-2 py-0.5 rounded-md border border-slate-200/40">Media Dakwah</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- TOGGLE FITUR: DOWNLOAD CENTER UTAMA -->
        @if($setting->feature_download)
        <div class="mt-16 p-6 bg-white rounded-3xl border border-slate-200 flex flex-col sm:flex-row justify-between items-center gap-4 max-w-3xl mx-auto shadow-sm">
            <div class="flex items-center gap-4 text-center sm:text-left flex-col sm:flex-row">
                <div class="text-3xl text-rose-500"><i class="fa-solid fa-file-pdf"></i></div>
                <div>
                    <h5 class="font-bold text-sm text-slate-900">Unduh Silabus &amp; Dokumen Kurikulum</h5>
                    <p class="text-xs text-slate-400 font-light">Dapatkan rincian pembagian jam studi, kalender akademik, dan silabus teknologi.</p>
                </div>
            </div>
            @if(isset($pendidikanSettings['file_brosur']) && !empty($pendidikanSettings['file_brosur']))
                <a href="{{ asset('storage/' . $pendidikanSettings['file_brosur']) }}" download class="bg-slate-900 hover:bg-slate-800 text-cyan-400 text-xs font-bold px-5 py-3 rounded-xl transition whitespace-nowrap border border-slate-700 shadow-sm text-center w-full sm:w-auto block">
                    <i class="fa-solid fa-download mr-1.5"></i> Unduh Silabus (.PDF)
                </a>
            @else
                <a href="#" onclick="alert('Berkas dokumen silabus PDF belum diunggah oleh admin.'); return false;" class="bg-slate-200 text-slate-400 text-xs font-bold px-5 py-3 rounded-xl transition whitespace-nowrap cursor-not-allowed text-center w-full sm:w-auto block select-none">
                    <i class="fa-solid fa-download mr-1.5"></i> Belum Tersedia
                </a>
            @endif
        </div>
        @endif
    </section>

    <!-- Aktivitas Lini Masa Harian (Agenda Rutin Santri) -->
    <section class="max-w-4xl mx-auto px-4 py-12 mb-20 border-t border-slate-200/80">
        <div class="text-center mb-12">
            <span class="text-[10px] font-bold uppercase tracking-widest text-teal-600 block mb-1">Siklus Kehidupan Kampus</span>
            <h3 class="text-2xl font-black text-slate-900 tracking-tight">Agenda Aktivitas Harian Santri</h3>
            <div class="w-8 h-1 bg-teal-500 mx-auto mt-3 rounded-full"></div>
        </div>

        <!-- Timeline Grid Block Style Dinamis -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden divide-y divide-slate-100">
            @php
                $fallbackTimes = [1 => '04.00 - 05.30', 2 => '07.15 - 12.00', 3 => '14.00 - 15.15', 4 => '18.30 - 20.30'];
                $fallbackTitles = [1 => 'Halaqah Fajar & Setoran Hafalan Al-Qur\'an', 2 => 'KBM Akademik & Laboratorium Praktik', 3 => 'Kelas Sinkronisasi Bahasa & Pengkajian Hukum', 4 => 'Evaluasi Mandiri & Pengayaan Materi Dakwah'];
                $fallbackTexts = [
                    1 => 'Shalat Subuh berjamaah, pembacaan zikir pagi bersama, dilanjutkan dengan setoran hafalan target individu di bawah pantauan ustadz pengampu halaqah.',
                    2 => 'Santri mengikuti proses belajar sekolah umum berbasis kurikulum nasional yang diintegrasikan langsung di ruang kelas multimedia dan laboratorium riset komputer.',
                    3 => 'Pelatihan intensif percakapan dwi-bahasa aktif (Arab-Inggris) dikombinasikan dengan pendalaman kajian kontekstual kitab fikih dasar ma\'had.',
                    4 => 'Shalat Maghrib dan Isya berjamaah, dilanjutkan bimbingan pembuatan karya digital dakwah serta murajaah mandiri sebelum istirahat malam asrama.'
                ];
            @endphp

            @for($i = 1; $i <= 4; $i++)
            <div class="p-5 sm:grid sm:grid-cols-4 sm:gap-6 items-center hover:bg-slate-50/50 transition">
                <div class="text-teal-600 text-xs font-bold tracking-wider uppercase mb-1 sm:mb-0 flex items-center gap-1.5 font-mono">
                    <i class="fa-regular fa-clock text-[11px]"></i> {{ $pendidikanSettings["agenda_{$i}_waktu"] ?? $fallbackTimes[$i] }}
                </div>
                <div class="sm:col-span-3">
                    <h5 class="font-bold text-slate-900 text-sm tracking-tight">{{ $pendidikanSettings["agenda_{$i}_judul"] ?? $fallbackTitles[$i] }}</h5>
                    <p class="text-slate-400 text-xs mt-1 font-light leading-relaxed">
                        {{ $pendidikanSettings["agenda_{$i}_teks"] ?? $fallbackTexts[$i] }}
                    </p>
                </div>
            </div>
            @endfor
        </div>
    </section>

@endsection