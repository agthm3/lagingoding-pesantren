@extends('layouts.dashboard')

@section('content')
    <main class="grow flex flex-col min-w-0">
        
        <!-- Header Top Bar -->
        <header class="bg-white border-b border-slate-200/60 px-6 py-4 flex justify-between items-center sticky top-0 z-30 shadow-sm shadow-slate-100/50">
            <div class="flex items-center gap-3">
                <button class="md:hidden text-slate-600"><i class="fa-solid fa-bars text-lg"></i></button>
                <h3 class="text-slate-900 font-black text-sm md:text-base tracking-tight">Database Penerimaan Santri Baru (PPDB)</h3>
            </div>
            <div class="text-xs font-bold text-slate-500 flex items-center gap-2">
                <button type="button" onclick="Swal.fire('Fitur Premium!', 'Integrasi Ekspor Excel otomatis tersedia di paket Enterprise.', 'info')" class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-2 rounded-xl transition flex items-center gap-1.5 shadow-sm shadow-indigo-600/10">
                    <i class="fa-solid fa-file-excel"></i> Ekspor Excel
                </button>
            </div>
        </header>

        <!-- Container Isi Dokumen -->
        <div class="p-6 space-y-6 overflow-y-auto grow">
            
            <!-- PANEL SELEKSI & PENCARIAN DATA (Filter Bar Terpadu) -->
            <section class="bg-white border border-slate-200/80 rounded-2xl p-4 shadow-sm flex flex-col lg:flex-row justify-between items-center gap-4">
                <form action="{{ route('dashboard.pendaftaran.index') }}" method="GET" id="ppdbFilterForm" class="flex flex-wrap items-center gap-3 w-full lg:w-auto text-xs font-bold">
                    
                    <!-- Cari Nama -->
                    <div class="relative w-full sm:w-60">
                        <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama calon santri..." class="w-full border border-slate-200 rounded-xl pl-9 pr-4 py-2.5 bg-slate-50 focus:outline-none focus:border-indigo-500 focus:bg-white shadow-inner transition font-medium">
                        <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-3.5 text-slate-400"></i>
                    </div>
                    
                    <!-- Filter Jenjang -->
                    <select name="jenjang" onchange="document.getElementById('ppdbFilterForm').submit()" class="border border-slate-200 bg-slate-50 px-3 py-2.5 rounded-xl text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition cursor-pointer w-full sm:w-auto">
                        <option value="">Semua Jenjang</option>
                        <option value="MTs" {{ $filter_jenjang == 'MTs' ? 'selected' : '' }}>Madrasah Tsanawiyah (MTs)</option>
                        <option value="MA" {{ $filter_jenjang == 'MA' ? 'selected' : '' }}>Madrasah Aliyah (MA)</option>
                        <option value="Tahfidz" {{ $filter_jenjang == 'Tahfidz' ? 'selected' : '' }}>Inkubator Tahfidz Digital</option>
                    </select>
                    
                    <!-- Filter Status Verifikasi -->
                    <select name="status" onchange="document.getElementById('ppdbFilterForm').submit()" class="border border-slate-200 bg-slate-50 px-3 py-2.5 rounded-xl text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition cursor-pointer w-full sm:w-auto">
                        <option value="">Semua Status</option>
                        <option value="Review" {{ $filter_status == 'Review' ? 'selected' : '' }}>Menunggu Review</option>
                        <option value="Lolos" {{ $filter_status == 'Lolos' ? 'selected' : '' }}>Lolos Seleksi</option>
                        <option value="Ditolak" {{ $filter_status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>

                    @if($search || $filter_jenjang || $filter_status)
                        <a href="{{ route('dashboard.pendaftaran.index') }}" class="text-indigo-600 hover:text-indigo-800 text-xs font-bold pl-1">Reset</a>
                    @endif
                </form>
                
                <div class="text-[11px] text-slate-400 font-bold self-end lg:self-center">
                    Menampilkan <span class="text-slate-900">{{ $totalTampil }}</span> dari <span class="text-slate-900">{{ $totalPendaftar }}</span> Pendaftar
                </div>
            </section>

            <!-- TABEL UTAMA DATABASE PENDAFTAR -->
            <section class="bg-white border border-slate-200/80 rounded-2xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="border-b border-slate-200 text-slate-400 font-black bg-slate-50/70 uppercase tracking-wider text-[10px]">
                                <th class="p-4">No. Reg</th>
                                <th class="p-4">Nama Santri</th>
                                <th class="p-4">Pilihan Jenjang</th>
                                <th class="p-4">Kontak Wali</th>
                                <th class="p-4">Berkas Syarat</th>
                                <th class="p-4">Status Akreditasi</th>
                                <th class="p-4 text-center">Aksi Operasional</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                            
                            @forelse ($daftar_pendaftar as $santri)
                            <tr class="hover:bg-slate-50/40 transition">
                                <td class="p-4 font-mono text-slate-400">#{{ $santri->no_registrasi }}</td>
                                <td class="p-4">
                                    <h5 class="font-bold text-slate-900 text-sm">{{ $santri->nama_santri }}</h5>
                                    <span class="text-[10px] text-slate-400 block font-normal mt-0.5">{{ $santri->jenis_kelamin }} • {{ $santri->asal_daerah }}</span>
                                </td>
                                <td class="p-4">
                                    <span class="bg-indigo-50 text-indigo-700 px-2.5 py-1 rounded-lg text-[10px] font-black tracking-wide border border-indigo-100 uppercase">
                                        {{ $santri->jenjang }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    <p class="font-bold text-slate-900">{{ $santri->nama_wali }}</p>
                                    <span class="text-[10px] text-slate-400 block font-normal mt-0.5"><i class="fa-brands fa-whatsapp text-emerald-500"></i> {{ $santri->kontak_wali }}</span>
                                </td>
                                <td class="p-4 space-x-1 whitespace-nowrap">
                                    <a href="{{ asset('storage/berkas/' . $santri->berkas_kk) }}" target="_blank" class="bg-slate-100 hover:bg-slate-200 text-slate-800 px-2 py-1 rounded text-[10px] font-bold border border-slate-200 transition inline-block"><i class="fa-solid fa-file-pdf text-red-500 mr-1"></i> KK</a>
                                    <a href="{{ asset('storage/berkas/' . $santri->berkas_akta) }}" target="_blank" class="bg-slate-100 hover:bg-slate-200 text-slate-800 px-2 py-1 rounded text-[10px] font-bold border border-slate-200 transition inline-block"><i class="fa-solid fa-file-pdf text-red-500 mr-1"></i> Akta</a>
                                </td>
                                <td class="p-4">
                                    @if ($santri->status === 'Review')
                                        <span class="bg-amber-50 text-amber-700 border border-amber-100 px-2.5 py-0.5 rounded-full text-[10px] font-bold shadow-sm inline-block"><i class="fa-regular fa-clock mr-1"></i> Menunggu Review</span>
                                    @elseif ($santri->status === 'Lolos') {{-- Di sini perbaikannya: gunakan @elseif --}}
                                        <span class="bg-emerald-50 text-emerald-700 border border-emerald-100 px-2.5 py-0.5 rounded-full text-[10px] font-bold shadow-sm inline-block"><i class="fa-solid fa-circle-check mr-1"></i> Terverifikasi Lolos</span>
                                    @else
                                        <span class="bg-rose-50 text-rose-700 border border-rose-100 px-2.5 py-0.5 rounded-full text-[10px] font-bold shadow-sm inline-block"><i class="fa-solid fa-circle-xmark mr-1"></i> Ditolak</span>
                                    @endif
                                </td>
                                <td class="p-4 text-center space-x-1 whitespace-nowrap">
                                    @if ($santri->status === 'Review')
                                        <!-- Saklar Lolos -->
                                        <form action="{{ route('dashboard.pendaftaran.updateStatus', $santri->id) }}" method="POST" id="status-lolos-{{ $santri->id }}" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="Lolos">
                                            <button type="button" onclick="confirmStatusChange('{{ $santri->id }}', 'Lolos', '{{ $santri->nama_santri }}')" class="bg-emerald-500 hover:bg-emerald-600 text-white w-7 h-7 rounded-lg transition text-xs shadow-sm shadow-emerald-500/10" title="Verifikasi Lolos"><i class="fa-solid fa-check"></i></button>
                                        </form>
                                        
                                        <!-- Saklar Tolak -->
                                        <form action="{{ route('dashboard.pendaftaran.updateStatus', $santri->id) }}" method="POST" id="status-tolak-{{ $santri->id }}" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="Ditolak">
                                            <button type="button" onclick="confirmStatusChange('{{ $santri->id }}', 'Ditolak', '{{ $santri->nama_santri }}')" class="bg-rose-500 hover:bg-rose-600 text-white w-7 h-7 rounded-lg transition text-xs shadow-sm shadow-rose-500/10" title="Tolak Pendaftaran"><i class="fa-solid fa-xmark"></i></button>
                                        </form>
                                    @else
                                        <span class="text-xs text-slate-400 italic">Selesai diproses</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="p-8 text-center text-slate-400 italic font-medium">Tidak ada data berkas pendaftaran calon santri.</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

                <!-- KOMPONEN PAGINASI DATA HALAMAN LARAVEL -->
                @if ($daftar_pendaftar->hasPages())
                <div class="bg-slate-50/50 border-t border-slate-100 px-4 py-3 text-slate-500">
                    {{ $daftar_pendaftar->links() }}
                </div>
                @endif
            </section>
        </div>

        <!-- Footer -->
        <footer class="bg-white border-t border-slate-200/60 px-6 py-4 text-center text-[11px] text-slate-400 font-bold">
            <p>&copy; 2026 Core Engine Infrastructure SaaS Pesantren. Pemeliharaan Berkas oleh <a href="#" class="text-indigo-600 hover:underline">lagingoding.com</a></p>
        </footer>

    </main>

    <!-- Injeksi SweetAlert2 Resmi -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // ALERT SUCCESS FLASH INTERAKSI BACKEND
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil Diproses!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#4f46e5',
                customClass: { popup: 'rounded-2xl' }
            });
        @endif

        // ALERT ERROR FLASH INTERAKSI BACKEND
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal Mengeksekusi!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#e11d48',
                customClass: { popup: 'rounded-2xl' }
            });
        @endif

        // KONFIRMASI INTERAKTIF SAKLAR STATUS AKREDITASI VERIFIKASI PPDB
        function confirmStatusChange(id, targetStatus, namaSantri) {
            let judul = targetStatus === 'Lolos' ? 'Loloskan Calon Santri?' : 'Tolak Berkas Pendaftaran?';
            let teks = targetStatus === 'Lolos' 
                ? `Calon santri atas nama ${namaSantri} akan dinyatakan lolos seleksi berkas administrasi.`
                : `Berkas calon santri atas nama ${namaSantri} akan ditolak dari sistem penerimaan.`;
            let warnaTombol = targetStatus === 'Lolos' ? '#10b981' : '#e11d48';

            Swal.fire({
                title: judul,
                text: teks,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: warnaTombol,
                cancelButtonColor: '#94a3b8',
                confirmButtonText: targetStatus === 'Lolos' ? 'Ya, Verifikasi Lolos!' : 'Ya, Tolak!',
                cancelButtonText: 'Batal',
                customClass: { popup: 'rounded-2xl' }
            }).then((result) => {
                if (result.isConfirmed) {
                    if (targetStatus === 'Lolos') {
                        document.getElementById('status-lolos-' + id).submit();
                    } else {
                        document.getElementById('status-tolak-' + id).submit();
                    }
                }
            });
        }
    </script>
@endsection