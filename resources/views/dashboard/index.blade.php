@extends('layouts.dashboard')

@section('content')
    <main class="grow flex flex-col min-w-0">
        
        <header class="bg-white border-b border-slate-200/60 px-6 py-4 flex justify-between items-center sticky top-0 z-30 shadow-sm shadow-slate-100/50">
            <div class="flex items-center gap-3">
                <button class="md:hidden text-slate-600"><i class="fa-solid fa-bars text-lg"></i></button>
                <h3 class="text-slate-900 font-black text-sm md:text-base tracking-tight">Ringkasan Sistem Informasi</h3>
            </div>
            <div class="flex items-center gap-4 text-xs font-bold text-slate-500">
                <span><i class="fa-regular fa-calendar mr-1.5 text-indigo-600"></i> {{ $tanggalSekarang }}</span>
                <span class="text-slate-200">|</span>
                <a href="{{ url('/') }}" target="_blank" class="bg-white hover:bg-slate-50 text-slate-800 px-3 py-2 rounded-xl border border-slate-200 shadow-sm flex items-center gap-1.5 transition">
                    <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-indigo-600"></i> Tinjau Situs
                </a>
            </div>
        </header>

        <div class="p-6 space-y-6 overflow-y-auto grow">
            
            <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <div class="bg-white border border-slate-200/80 p-5 rounded-2xl shadow-sm flex justify-between items-center">
                    <div>
                        <span class="text-[10px] font-bold uppercase text-slate-400 tracking-wider">Total PPDB Masuk</span>
                        <h3 class="text-2xl font-black text-slate-900 mt-1">{{ $countPpdb }} <span class="text-xs text-slate-400 font-normal">Siswa</span></h3>
                    </div>
                    <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center text-sm shadow-inner"><i class="fa-solid fa-user-plus"></i></div>
                </div>
                <div class="bg-white border border-slate-200/80 p-5 rounded-2xl shadow-sm flex justify-between items-center">
                    <div>
                        <span class="text-[10px] font-bold uppercase text-slate-400 tracking-wider">Belum Diverifikasi</span>
                        <h3 class="text-2xl font-black text-amber-600 mt-1">{{ $countReview }} <span class="text-xs text-slate-400 font-normal">Berkas</span></h3>
                    </div>
                    <div class="w-10 h-10 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center text-sm shadow-inner"><i class="fa-regular fa-clock"></i></div>
                </div>
                <div class="bg-white border border-slate-200/80 p-5 rounded-2xl shadow-sm flex justify-between items-center">
                    <div>
                        <span class="text-[10px] font-bold uppercase text-slate-400 tracking-wider">Artikel Berita</span>
                        <h3 class="text-2xl font-black text-slate-900 mt-1">{{ $countBerita }} <span class="text-xs text-slate-400 font-normal">Warta</span></h3>
                    </div>
                    <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-sm shadow-inner"><i class="fa-regular fa-file-lines"></i></div>
                </div>
                <div class="bg-white border border-slate-200/80 p-5 rounded-2xl shadow-sm flex justify-between items-center">
                    <div>
                        <span class="text-[10px] font-bold uppercase text-slate-400 tracking-wider">Fasilitas Terdata</span>
                        <h3 class="text-2xl font-black text-slate-900 mt-1">{{ $countSarana }} <span class="text-xs text-slate-400 font-normal">Aset</span></h3>
                    </div>
                    <div class="w-10 h-10 bg-slate-50 text-slate-700 rounded-xl flex items-center justify-center text-sm shadow-inner"><i class="fa-regular fa-building"></i></div>
                </div>
            </section>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                
                <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm lg:col-span-8 space-y-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h4 class="text-sm font-black text-slate-900 tracking-tight">Pendaftaran PPDB Masuk Terbaru</h4>
                            <p class="text-[11px] text-slate-400 font-normal mt-0.5">Daftar calon santri baru yang baru saja melakukan submit berkas online.</p>
                        </div>
                        <a href="{{ route('dashboard.pendaftaran.index') }}" class="text-[11px] font-bold text-indigo-600 hover:underline">Lihat Semua</a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs border-collapse">
                            <thead>
                                <tr class="border-b border-slate-100 text-slate-400 font-bold bg-slate-50/50">
                                    <th class="p-3">Nama Santri</th>
                                    <th class="p-3">Jenjang</th>
                                    <th class="p-3">Tanggal Daftar</th>
                                    <th class="p-3 text-right">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50 font-medium text-slate-700">
                                @forelse ($pendaftarTerbaru as $santri)
                                <tr class="hover:bg-slate-50/30 transition">
                                    <td class="p-3 font-bold text-slate-900">{{ $santri->nama_santri }}</td>
                                    <td class="p-3"><span class="bg-indigo-50 text-indigo-700 px-2 py-0.5 rounded text-[10px] font-bold border border-indigo-100 uppercase">{{ $santri->jenjang }}</span></td>
                                    <td class="p-3 text-slate-400">{{ $santri->created_at->translatedFormat('d M Y') }}</td>
                                    <td class="p-3 text-right">
                                        @if ($santri->status === 'Review')
                                            <span class="bg-amber-50 text-amber-700 border border-amber-100 px-2 py-0.5 rounded text-[10px] font-bold">Menunggu Review</span>
                                        @elif ($santri->status === 'Lolos')
                                            <span class="bg-emerald-50 text-emerald-700 border border-emerald-100 px-2 py-0.5 rounded text-[10px] font-bold">Terverifikasi</span>
                                        @else
                                            <span class="bg-rose-50 text-rose-700 border border-rose-100 px-2 py-0.5 rounded text-[10px] font-bold">Ditolak</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="p-4 text-center italic text-slate-400 font-medium">Belum ada berkas formulir PPDB yang masuk.</td>
                                <tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm lg:col-span-4 space-y-4">
                    <div>
                        <h4 class="text-sm font-black text-slate-900 tracking-tight">Informasi Lingkungan</h4>
                        <p class="text-[11px] text-slate-400 font-normal mt-0.5">Status dan konfigurasi global yang berjalan.</p>
                    </div>

                    <div class="space-y-3.5 text-xs font-semibold">
                        <div class="p-3 rounded-xl border border-slate-100 bg-slate-50/50 flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <i class="fa-solid fa-palette text-indigo-600 text-sm"></i>
                                <span class="text-slate-600">Wajah Tema</span>
                            </div>
                            <span class="text-slate-900 font-bold bg-white border border-slate-200 px-2.5 py-1 rounded-lg shadow-sm capitalize">{{ $setting->active_theme == 'islami' ? 'Islami Tradisional' : $setting->active_theme }}</span>
                        </div>
                        
                        <div class="p-3 rounded-xl border border-slate-100 bg-slate-50/50 flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <i class="fa-solid fa-shield-halved text-emerald-600 text-sm"></i>
                                <span class="text-slate-600">Status Lisensi</span>
                            </div>
                            <span class="font-bold px-2.5 py-1 text-[11px] rounded-lg shadow-sm {{ $badgeClass }}">
                                {{ $licenseStatusText }}
                            </span>
                        </div>

                        <div class="pt-2">
                            <span class="text-[10px] font-bold uppercase text-slate-400 tracking-wider block mb-2">Aktivitas Terakhir</span>
                            <div class="space-y-2.5 border-l-2 border-slate-100 pl-3.5 text-[11px] font-medium text-slate-600">
                                <div>
                                    <p class="text-slate-900 font-bold">Masa Berlaku Sewa Sistem</p>
                                    <span class="text-[10px] text-indigo-600 block mt-0.5 font-mono font-bold">Exp: {{ \Carbon\Carbon::parse($setting->license_expires_at)->translatedFormat('d M Y') }}</span>
                                </div>
                                <div>
                                    <p class="text-slate-900 font-bold">Koneksi Database MySQL Stabil</p>
                                    <span class="text-[10px] text-slate-400 block mt-0.5">Port 3306 Aktif</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <footer class="bg-white border-t border-slate-200/80 px-6 py-4 text-center text-[11px] text-slate-400 font-bold">
            <p>&copy; 2026 Core Engine Infrastructure SaaS Pesantren. Desain oleh <a href="#" class="text-indigo-600 hover:underline">lagingoding.com</a></p>
        </footer>

    </main>
@endsection