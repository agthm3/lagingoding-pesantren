@extends('layouts.dashboard')

@section('content')
    <main class="grow flex flex-col min-w-0">
        
        <header class="bg-white border-b border-slate-200/60 px-6 py-4 flex justify-between items-center sticky top-0 z-30 shadow-sm shadow-slate-100/50">
            <div class="flex items-center gap-3">
                <button class="md:hidden text-slate-600"><i class="fa-solid fa-bars text-lg"></i></button>
                <h3 class="text-slate-900 font-black text-sm md:text-base tracking-tight">Pusat Konfigurasi Sistem SaaS Klien</h3>
            </div>
        </header>

        <div class="p-6 space-y-8 overflow-y-auto grow">
            
            <form action="{{ route('dashboard.pengaturan.update') }}" method="POST" class="space-y-8 max-w-5xl w-full">
                @csrf
                @method('PUT')
                
                <section class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm space-y-4">
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-indigo-600 block mb-0.5">Wajah Antarmuka Klien</span>
                        <h4 class="text-sm font-black text-slate-900 tracking-tight">1. Pemilihan Tema Website Publik Utama</h4>
                        <p class="text-xs text-slate-400 font-light mt-0.5">Pilih salah satu folder arsitektur view front-end yang berhak merender tampilan luar pesantren ini.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        
                        <label class="border-2 {{ $setting->active_theme == 'formal' ? 'border-indigo-600 bg-indigo-50/10' : 'border-slate-100 bg-slate-50/30 hover:border-slate-200' }} rounded-2xl p-5 block cursor-pointer relative transition group">
                            <input type="radio" name="active_theme" value="formal" {{ $setting->active_theme == 'formal' ? 'checked' : '' }} class="absolute top-4 right-4 text-indigo-600 focus:ring-indigo-500 cursor-pointer">
                            <div class="w-9 h-9 bg-slate-100 text-slate-700 rounded-xl flex items-center justify-center text-sm mb-4"><i class="fa-solid fa-briefcase"></i></div>
                            <h5 class="text-xs font-bold text-slate-900 mb-1 flex items-center gap-1.5">
                                Tema Formal Korporat
                                @if($setting->active_theme == 'formal') <span class="bg-indigo-600 text-white text-[8px] px-1.5 py-0.5 rounded font-black tracking-wide">Aktif</span> @endif
                            </h5>
                            <p class="text-[11px] text-slate-400 leading-relaxed font-light">Gaya kaku konvensional, warna dominan navy/biru bersih. Cocok untuk kebutuhan sekolah islam nasional reguler.</p>
                        </label>
                        
                        <label class="border-2 {{ $setting->active_theme == 'islami' ? 'border-indigo-600 bg-indigo-50/10' : 'border-slate-100 bg-slate-50/30 hover:border-slate-200' }} rounded-2xl p-5 block cursor-pointer relative transition group">
                            <input type="radio" name="active_theme" value="islami" {{ $setting->active_theme == 'islami' ? 'checked' : '' }} class="absolute top-4 right-4 text-indigo-600 focus:ring-indigo-500 cursor-pointer">
                            <div class="w-9 h-9 bg-emerald-50 text-emerald-700 rounded-xl flex items-center justify-center text-sm mb-4"><i class="fa-solid fa-mosque"></i></div>
                            <h5 class="text-xs font-bold text-slate-900 mb-1 flex items-center gap-1.5">
                                Tema Islami Tradisional
                                @if($setting->active_theme == 'islami') <span class="bg-indigo-600 text-white text-[8px] px-1.5 py-0.5 rounded font-black tracking-wide">Aktif</span> @endif
                            </h5>
                            <p class="text-[11px] text-slate-400 leading-relaxed font-light">Kombinasi hijau pine tua dan aksen emas pasir, judul menggunakan font serif khidmat. Sempurna untuk pondok pesantren salafiyah.</p>
                        </label>
                        
                        <label class="border-2 {{ $setting->active_theme == 'modern' ? 'border-indigo-600 bg-indigo-50/10' : 'border-slate-100 bg-slate-50/30 hover:border-slate-200' }} rounded-2xl p-5 block cursor-pointer relative transition group">
                            <input type="radio" name="active_theme" value="modern" {{ $setting->active_theme == 'modern' ? 'checked' : '' }} class="absolute top-4 right-4 text-indigo-600 focus:ring-indigo-500 cursor-pointer">
                            <div class="w-9 h-9 bg-cyan-50 text-cyan-700 rounded-xl flex items-center justify-center text-sm mb-4"><i class="fa-solid fa-microchip"></i></div>
                            <h5 class="text-xs font-bold text-slate-900 mb-1 flex items-center gap-1.5">
                                Tema Modern Minimalis
                                @if($setting->active_theme == 'modern') <span class="bg-indigo-600 text-white text-[8px] px-1.5 py-0.5 rounded font-black tracking-wide">Aktif</span> @endif
                            </h5>
                            <p class="text-[11px] text-slate-400 leading-relaxed font-light">Konsep layout flat cerah, warna slate gray dan neon teal. Ditujukan khusus untuk kriteria boarding school digital.</p>
                        </label>
                        
                    </div>
                    @error('active_theme') <span class="text-red-500 text-[10px] block mt-1">{{ $message }}</span> @enderror
                </section>

                <section class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm space-y-4">
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-emerald-600 block mb-0.5">Saklar Akses Paket</span>
                        <h4 class="text-sm font-black text-slate-900 tracking-tight">2. Manajemen Hak Akses Komponen Fitur</h4>
                        <p class="text-xs text-slate-400 font-light mt-0.5">Aktifkan atau matikan modul halaman tertentu di bawah ini berdasarkan paket kuota sewa klien.</p>
                    </div>

                    <div class="border border-slate-200/60 rounded-2xl overflow-hidden divide-y divide-slate-100 bg-white text-xs">
                        
                        <div class="p-4 sm:flex justify-between items-center gap-6 hover:bg-slate-50/40 transition">
                            <div class="flex items-start gap-3.5 mb-3 sm:mb-0">
                                <div class="w-8 h-8 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0"><i class="fa-solid fa-graduation-cap"></i></div>
                                <div>
                                    <h5 class="font-bold text-slate-900">Modul PPDB Online (Pendaftaran Santri Baru)</h5>
                                    <p class="text-[11px] text-slate-400 font-light leading-normal">Mengizinkan sistem memuat boks menu pendaftaran bertahap di bar navigasi luar website publik.</p>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer select-none">
                                <input type="checkbox" name="feature_ppdb" value="1" {{ $setting->feature_ppdb ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500"></div>
                            </label>
                        </div>

                        <div class="p-4 sm:flex justify-between items-center gap-6 hover:bg-slate-50/40 transition">
                            <div class="flex items-start gap-3.5 mb-3 sm:mb-0">
                                <div class="w-8 h-8 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0"><i class="fa-regular fa-comments"></i></div>
                                <div>
                                    <h5 class="font-bold text-slate-900">Modul Akordion Tanya Jawab (FAQ Area)</h5>
                                    <p class="text-[11px] text-slate-400 font-light leading-normal">Mengaktifkan komponen seksi tanya jawab ringkas pada halaman beranda utama website.</p>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer select-none">
                                <input type="checkbox" name="feature_faq" value="1" {{ $setting->feature_faq ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500"></div>
                            </label>
                        </div>

                        <div class="p-4 sm:flex justify-between items-center gap-6 hover:bg-slate-50/40 transition">
                            <div class="flex items-start gap-3.5 mb-3 sm:mb-0">
                                <div class="w-8 h-8 rounded-xl bg-red-50 text-red-600 flex items-center justify-center shrink-0"><i class="fa-regular fa-file-pdf"></i></div>
                                <div>
                                    <h5 class="font-bold text-slate-900">Modul Unduh Dokumen Kurikulum (Download Center)</h5>
                                    <p class="text-[11px] text-slate-400 font-light leading-normal">Membuka tombol akses unduh berkas silabus PDF pelajaran bagi pengunjung umum di halaman program studi.</p>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer select-none">
                                <input type="checkbox" name="feature_download" value="1" {{ $setting->feature_download ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500"></div>
                            </label>
                        </div>

                    </div>
                </section>

                <div class="flex justify-end pt-2">
                    <button type="submit" class="w-full sm:w-auto bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold px-6 py-4 rounded-xl transition shadow-sm uppercase tracking-wider">
                        <i class="fa-solid fa-floppy-disk mr-2 text-indigo-400"></i> Simpan Konfigurasi Sistem
                    </button>
                </div>

            </form>
        </div>

        <footer class="bg-white border-t border-slate-200/60 px-6 py-4 text-center text-[11px] text-slate-400 font-bold">
            <p>&copy; 2026 Core Engine Infrastructure SaaS Pesantren. Pemeliharaan Sistem oleh <a href="#" class="text-indigo-600 hover:underline">lagingoding.com</a></p>
        </footer>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Notifikasi Sukses
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Konfigurasi Tersimpan!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#4f46e5',
                customClass: { popup: 'rounded-2xl' }
            });
        @endif

        // Notifikasi Gagal/Error
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal Menyimpan!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#e11d48',
                customClass: { popup: 'rounded-2xl' }
            });
        @endif
    </script>
@endsection