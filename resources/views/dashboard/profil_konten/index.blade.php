@extends('layouts.dashboard')

@section('content')
    <main class="grow flex flex-col min-w-0">
        
        <header class="bg-white border-b border-slate-200/60 px-6 py-4 flex justify-between items-center sticky top-0 z-30 shadow-sm shadow-slate-100/50">
            <div class="flex items-center gap-3">
                <button class="md:hidden text-slate-600"><i class="fa-solid fa-bars text-lg"></i></button>
                <h3 class="text-slate-900 font-black text-sm md:text-base tracking-tight">Kelola Konten Profil & Sambutan Landing Page</h3>
            </div>
        </header>

        <div class="p-6 overflow-y-auto grow">
            <form id="formProfilKonten" action="{{ route('dashboard.profil-konten.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8 max-w-5xl w-full">
                @csrf
                @method('PUT')

                <!-- SEKSI 1: IDENTITAS & SAMBUTAN PENGASUH -->
                <section class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm space-y-6">
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-indigo-600 block mb-0.5">Sambutan Utama Halaman Depan</span>
                        <h4 class="text-sm font-black text-slate-900 tracking-tight">1. Komponen Foto & Teks Sambutan Pengasuh</h4>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start">
                        <!-- Preview & Upload Foto -->
                        <div class="md:col-span-4 flex flex-col items-center justify-center p-4 bg-slate-50 border border-slate-200 rounded-xl space-y-3">
                            @if(isset($settings['sambutan_foto']))
                                <img src="{{ asset('storage/' . $settings['sambutan_foto']) }}" class="w-28 h-36 object-cover rounded-xl border border-slate-200 shadow-sm">
                            @else
                                <div class="w-28 h-36 bg-white border border-dashed border-slate-200 rounded-xl flex flex-col items-center justify-center text-[10px] text-slate-400 font-medium"><i class="fa-regular fa-image text-lg mb-1"></i> Belum Ada Foto</div>
                            @endif
                            <input type="file" id="input_sambutan_foto" name="sambutan_foto" accept=".jpg,.jpeg,.png,.webp" class="w-full text-[10px] text-slate-500 file:mr-2 file:py-1 file:px-2 file:rounded-lg file:border file:border-slate-200 file:text-[10px] file:font-bold file:bg-slate-900 file:text-cyan-400 cursor-pointer">
                            <span id="error_sambutan" class="text-[10px] text-rose-500 font-bold block hidden"><i class="fa-solid fa-triangle-exclamation mr-1"></i>Ukuran melebihi batas 1 MB!</span>
                        </div>

                        <!-- Input Teks Nama & Jabatan -->
                        <div class="md:col-span-8 space-y-4 w-full">
                            <div>
                                <label class="block text-[11px] font-bold text-slate-700 mb-1.5">Nama Lengkap & Gelar Akademis Pengasuh *</label>
                                <input type="text" id="sambutan_nama" name="sambutan_nama" value="{{ $settings['sambutan_nama'] ?? 'KH. Ahmad Mustofa, M.Pd' }}" required class="w-full text-xs border border-slate-200 rounded-xl p-3 bg-slate-50 focus:outline-none focus:border-indigo-500 focus:bg-white shadow-inner transition text-slate-800 font-medium">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-700 mb-1.5">Jabatan / Riwayat Pendidikan / Asal Sekolah Khidmat *</label>
                                <input type="text" id="sambutan_jabatan" name="sambutan_jabatan" value="{{ $settings['sambutan_jabatan'] ?? 'Khadimul Ma&#039;had Pascasarjana' }}" required class="w-full text-xs border border-slate-200 rounded-xl p-3 bg-slate-50 focus:outline-none focus:border-indigo-500 focus:bg-white shadow-inner transition text-slate-800 font-medium">
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1.5">Isi Teks Paragraf Redaksi Sambutan Pengasuh *</label>
                        <textarea name="sambutan_teks" rows="5" required placeholder="Masukkan naskah kalimat sambutan hangat pengasuh..." class="w-full font-medium border border-slate-200 rounded-xl p-3 bg-slate-50 focus:outline-none focus:border-indigo-500 focus:bg-white shadow-inner transition text-xs text-slate-800 leading-relaxed resize-none">{{ $settings['sambutan_teks'] ?? '' }}</textarea>
                    </div>
                </section>

                <!-- SEKSI 2: TARIKH SEJARAH & KHITTAH VISI MISI -->
                <section class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm space-y-5">
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-emerald-600 block mb-0.5">Informasi Profil Kebijakan</span>
                        <h4 class="text-sm font-black text-slate-900 tracking-tight">2. Narasi Kronik Sejarah Asal Usul, Khittah Visi, dan Misi Halaman Profil</h4>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1.5">Redaksi Narasi Sejarah Berdirinya Ma'had *</label>
                        <textarea name="sejarah_teks" rows="6" required placeholder="Tuliskan butir-butir kronologi berdirinya pesantren untuk halaman profil..." class="w-full font-medium border border-slate-200 rounded-xl p-3 bg-slate-50 focus:outline-none focus:border-emerald-500 focus:bg-white shadow-inner transition text-xs text-slate-800 leading-relaxed resize-none">{{ $settings['sejarah_teks'] ?? '' }}</textarea>
                    </div>

                    <div class="border-t border-b border-slate-100 py-4 my-2">
                        <label class="block text-[11px] font-bold text-slate-700 mb-2"><i class="fa-regular fa-image mr-1 text-emerald-600"></i> Foto Dokumentasi Samping Sejarah Ma'had</label>
                        <div class="flex flex-col sm:flex-row gap-4 items-center">
                            @if(isset($settings['sejarah_foto']))
                                <img src="{{ asset('storage/' . $settings['sejarah_foto']) }}" class="w-40 h-24 object-cover rounded-xl border border-slate-200 shadow-sm">
                            @else
                                <div class="w-40 h-24 bg-slate-50 border border-dashed border-slate-200 rounded-xl flex items-center justify-center text-[10px] text-slate-400 font-medium">Belum Ada Foto Dokumentasi</div>
                            @endif
                            <div class="grow">
                                <input type="file" id="input_sejarah_foto" name="sejarah_foto" accept=".jpg,.jpeg,.png,.webp" class="text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border file:border-slate-200 file:bg-slate-900 file:text-white cursor-pointer">
                                <span id="error_sejarah_foto" class="text-[10px] text-rose-500 font-bold block mt-1 hidden">Ukuran file sejarah melebihi batas 1 MB!</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1.5">Pernyataan Teks Visi Utama Ma'had *</label>
                        <textarea name="visi_teks" rows="3" required placeholder="Contoh: Menjadi pusat pendidikan Islam aswaja terdepan..." class="w-full font-medium border border-slate-200 rounded-xl p-3 bg-slate-50 focus:outline-none focus:border-emerald-500 focus:bg-white shadow-inner transition text-xs text-slate-800 leading-relaxed resize-none">{{ $settings['visi_teks'] ?? '' }}</textarea>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1.5">Butir-Butir Poin Misi Pesantren *</label>
                        <textarea name="visi_misi_teks" rows="6" required placeholder="Gunakan enter untuk membuat poin baru..." class="w-full font-medium border border-slate-200 rounded-xl p-3 bg-slate-50 focus:outline-none focus:border-emerald-500 focus:bg-white shadow-inner transition text-xs text-slate-800 leading-relaxed" style="white-space: pre-line;">{{ $settings['visi_misi_teks'] ?? '' }}</textarea>
                    </div>
                </section>

                <!-- SEKSI 3: KONTEN PROGRAM PENDIDIKAN, BROSUR & AGENDA HARIAN (GABUNG DI SINI) -->
                <section class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm space-y-6">
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-teal-600 block mb-0.5">Sistem Kurikulum & Agenda</span>
                        <h4 class="text-sm font-black text-slate-900 tracking-tight">3. Manajemen Program Pendidikan, Brosur PDF & Aktivitas Harian</h4>
                    </div>

                    <!-- Input Deskripsi Tiga Jenjang -->
                    <div class="grid grid-cols-1 gap-4 border-b border-slate-100 pb-5">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 mb-1.5">Deskripsi Program Madrasah Tsanawiyah (MTs) *</label>
                            <textarea name="pendidikan_mts" rows="2" required class="w-full font-medium border border-slate-200 rounded-xl p-3 bg-slate-50 focus:outline-none focus:border-teal-500 focus:bg-white shadow-inner transition text-xs text-slate-800 leading-relaxed resize-none">{{ $settings['pendidikan_mts'] ?? 'Pendidikan setingkat SMP yang mengintegrasikan kurikulum dasar Kementerian Agama dengan pendalaman kitab khazanah Islam klasik tingkat dasar serta bimbingan ibadah harian.' }}</textarea>
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 mb-1.5">Deskripsi Program Madrasah Aliyah (MA) *</label>
                            <textarea name="pendidikan_ma" rows="2" required class="w-full font-medium border border-slate-200 rounded-xl p-3 bg-slate-50 focus:outline-none focus:border-teal-500 focus:bg-white shadow-inner transition text-xs text-slate-800 leading-relaxed resize-none">{{ $settings['pendidikan_ma'] ?? 'Pendidikan setingkat SMA yang mempersiapkan santri untuk melanjutkan ke perguruan tinggi nasional maupun internasional (Timur Tengah) dengan penguasaan bahasa Arab aktif.' }}</textarea>
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 mb-1.5">Deskripsi Program Tahfidzul Qur'an *</label>
                            <textarea name="pendidikan_tahfidz" rows="2" required class="w-full font-medium border border-slate-200 rounded-xl p-3 bg-slate-50 focus:outline-none focus:border-teal-500 focus:bg-white shadow-inner transition text-xs text-slate-800 leading-relaxed resize-none">{{ $settings['pendidikan_tahfidz'] ?? 'Program khusus berfokus pada hafalan Al-Qur\'an dengan metode talaqqi langsung di bawah bimbingan para huffadz bersanad, dilengkapi dengan ilmu tajwid dan ghorib.' }}</textarea>
                        </div>
                    </div>

                    <!-- Input Upload Dokumen Brosur PDF -->
                    <div class="border-b border-slate-100 pb-5">
                        <label class="block text-[11px] font-bold text-slate-700 mb-2"><i class="fa-solid fa-file-pdf mr-1 text-red-600"></i> Berkas Brosur / Silabus Kurikulum (.PDF)</label>
                        <div class="flex flex-col sm:flex-row gap-4 items-center bg-slate-50 p-4 rounded-xl border border-slate-200">
                            @if(isset($settings['file_brosur']))
                                <div class="text-[11px] bg-white border border-slate-200 px-3 py-1.5 rounded-lg shrink-0 font-medium text-slate-700 shadow-sm">
                                    <a href="{{ asset('storage/' . $settings['file_brosur']) }}" target="_blank" class="text-indigo-600 hover:underline"><i class="fa-solid fa-paperclip mr-1"></i>Brosur Aktif</a>
                                </div>
                            @endif
                            <div class="grow w-full">
                                <input type="file" id="file_brosur" name="file_brosur" accept=".pdf" class="w-full text-slate-500 font-medium file:mr-3 file:py-1 file:px-2 file:rounded-lg file:border file:border-slate-200 file:text-[10px] file:font-bold file:bg-slate-900 file:text-white cursor-pointer">
                                <span id="error_brosur_pdf" class="text-[10px] text-rose-500 font-bold block mt-1 hidden">Berkas PDF melebihi batasan kuota 4 MB!</span>
                            </div>
                        </div>
                    </div>

                    <!-- Input 4 Baris Aktivitas Harian Dinamis -->
                    <div class="space-y-4">
                        <label class="block text-[11px] font-bold text-slate-700"><i class="fa-regular fa-clock mr-1 text-indigo-600"></i> Struktur Jadwal Aktivitas Harian Santri</label>
                        
                        @php
                            $defaultWaktu = [1 => '04.00 - 05.15', 2 => '07.15 - 12.00', 3 => '14.00 - 15.15', 4 => '18.30 - 20.00'];
                            $defaultJudul = [1 => 'Shalat Subuh Berjamaah & Khitabah', 2 => 'KBM Madrasah Formal', 3 => 'Kajian Kitab Kuning (Madrasah Diniyah)', 4 => 'Maghrib Mengaji & Isya Berjamaah'];
                            $defaultAgenda = [
                                1 => 'Dilanjutkan dengan membaca wirid pagi dan setoran hafalan Al-Qur\'an / bait muhafadhah.',
                                2 => 'Pembelajaran kurikulum nasional (Kemenag/Kemendikbud) di ruang kelas masing-masing jenjang.',
                                3 => 'Pendalaman materi fiqih, nahwu, sharaf, aqidah, dan akhlak menggunakan metode bandongan/sorogan.',
                                4 => 'Pendalaman hafalan juz individu dipandu langsung oleh ustadz pembimbing halaqah.'
                            ];
                        @endphp

                        @for($i = 1; $i <= 4; $i++)
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-3 items-center p-3 bg-slate-50 border border-slate-200 rounded-xl shadow-sm">
                            <div class="md:col-span-3">
                                <input type="text" name="agenda_{{ $i }}_waktu" value="{{ $settings["agenda_{$i}_waktu"] ?? $defaultWaktu[$i] }}" required class="w-full text-xs border border-slate-200 rounded-lg p-2 bg-white text-center font-mono font-bold text-teal-800">
                            </div>
                            <div class="md:col-span-4">
                                <input type="text" name="agenda_{{ $i }}_judul" value="{{ $settings["agenda_{$i}_judul"] ?? $defaultJudul[$i] }}" required class="w-full text-xs border border-slate-200 rounded-lg p-2 bg-white font-bold text-slate-800">
                            </div>
                            <div class="md:col-span-5">
                                <input type="text" name="agenda_{{ $i }}_teks" value="{{ $settings["agenda_{$i}_teks"] ?? $defaultAgenda[$i] }}" required class="w-full text-xs border border-slate-200 rounded-lg p-2 bg-white text-slate-500 font-light">
                            </div>
                        </div>
                        @endfor
                    </div>
                </section>

                <!-- SEKSI 4: BAGAN STRUKTUR ORGANISASI -->
                <section class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm space-y-4">
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-amber-600 block mb-0.5">Visualisasi Organisasi</span>
                        <h4 class="text-sm font-black text-slate-900 tracking-tight">4. Bagan Gambar Infografis Silsilah Pengurus Syura</h4>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-5 items-start sm:items-center">
                        @if(isset($settings['struktur_pengurus']))
                            <img src="{{ asset('storage/' . $settings['struktur_pengurus']) }}" class="w-36 h-24 object-cover rounded-xl border border-slate-200 shadow-inner">
                        @else
                            <div class="w-36 h-24 bg-slate-50 border border-dashed border-slate-200 rounded-xl flex flex-col items-center justify-center text-[10px] text-slate-400 font-medium"><i class="fa-solid fa-sitemap text-lg mb-1"></i> Belum ada bagan</div>
                        @endif
                        <div class="space-y-1.5 grow">
                            <input type="file" id="input_struktur_pengurus" name="struktur_pengurus" accept=".jpg,.jpeg,.png,.webp" class="w-full text-slate-500 font-medium file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border file:border-slate-200 file:text-xs file:font-bold file:bg-slate-900 file:text-cyan-400 cursor-pointer">
                            <span class="text-[10px] text-slate-400 font-normal block">Disarankan landscape horizontal. Batas kapasitas dokumen: 1 Megabyte.</span>
                            <span id="error_struktur" class="text-[10px] text-rose-500 font-bold block hidden"><i class="fa-solid fa-triangle-exclamation mr-1"></i>Berkas bagan organisasi melebihi batas 1 MB!</span>
                        </div>
                    </div>
                </section>

                <div class="flex justify-end pt-2">
                    <button type="submit" class="w-full sm:w-auto bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold px-6 py-4 rounded-xl transition shadow-sm uppercase tracking-wider">
                        <i class="fa-solid fa-floppy-disk mr-2 text-indigo-400"></i> Amankan &amp; Publikasikan Konten
                    </button>
                </div>
            </form>
        </div>

        <footer class="bg-white border-t border-slate-200/60 px-6 py-4 text-center text-[11px] text-slate-400 font-bold">
            <p>&copy; 2026 Core Engine Infrastructure SaaS Pesantren. Pemeliharaan oleh <a href="#" class="text-indigo-600 hover:underline">lagingoding.com</a></p>
        </footer>
    </main>

    <!-- JS VALIDATOR & POP-UP MANAGEMENT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const MAX_FILE_SIZE = 1 * 1024 * 1024; // 1 MB
        const MAX_PDF_SIZE = 4 * 1024 * 1024;  // 4 MB untuk brosur

        document.getElementById('input_sambutan_foto').addEventListener('change', function() {
            const err = document.getElementById('error_sambutan');
            if (this.files[0] && this.files[0].size > MAX_FILE_SIZE) { err.classList.remove('hidden'); } else { err.classList.add('hidden'); }
        });

        document.getElementById('input_sejarah_foto').addEventListener('change', function() {
            const err = document.getElementById('error_sejarah_foto');
            if (this.files[0] && this.files[0].size > MAX_FILE_SIZE) { err.classList.remove('hidden'); } else { err.classList.add('hidden'); }
        });

        document.getElementById('file_brosur').addEventListener('change', function() {
            const err = document.getElementById('error_brosur_pdf');
            if (this.files[0] && this.files[0].size > MAX_PDF_SIZE) { err.classList.remove('hidden'); } else { err.classList.add('hidden'); }
        });

        document.getElementById('input_struktur_pengurus').addEventListener('change', function() {
            const err = document.getElementById('error_struktur');
            if (this.files[0] && this.files[0].size > MAX_FILE_SIZE) { err.classList.remove('hidden'); } else { err.classList.add('hidden'); }
        });

        document.getElementById('formProfilKonten').addEventListener('submit', function(e) {
            const fSambutan = document.getElementById('input_sambutan_foto');
            const fSejarah = document.getElementById('input_sejarah_foto');
            const fBrosur = document.getElementById('file_brosur');
            const fStruktur = document.getElementById('input_struktur_pengurus');

            if (fSambutan.files[0] && fSambutan.files[0].size > MAX_FILE_SIZE || fSejarah.files[0] && fSejarah.files[0].size > MAX_FILE_SIZE || fStruktur.files[0] && fStruktur.files[0].size > MAX_FILE_SIZE) {
                e.preventDefault();
                Swal.fire({ icon: 'error', title: 'File Terlalu Besar', text: 'Terdapat berkas gambar yang melebihi batas ketentuan 1 Megabyte.', confirmButtonColor: '#e11d48', customClass: { popup: 'rounded-2xl' } });
                return;
            }
            if (fBrosur.files[0] && fBrosur.files[0].size > MAX_PDF_SIZE) {
                e.preventDefault();
                Swal.fire({ icon: 'error', title: 'File PDF Terlalu Besar', text: 'Kapasitas berkas PDF brosur melebihi ambang kuota 4 MB.', confirmButtonColor: '#e11d48', customClass: { popup: 'rounded-2xl' } });
                return;
            }

            Swal.fire({
                title: 'Menyimpan Konten Profil',
                html: 'Mohon tunggu, naskah narasi dan berkas media baru sedang diunggah ke server...',
                allowOutsideClick: false, didOpen: () => { Swal.showLoading(); }, customClass: { popup: 'rounded-2xl' }
            });
        });

        @if(session('success'))
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: '{{ session('success') }}', confirmButtonColor: '#4f46e5', customClass: { popup: 'rounded-2xl' } });
        @endif

        @if(session('error') || $errors->any())
            Swal.fire({ icon: 'error', title: 'Gagal Menyimpan!', text: '{{ session('error') ?: $errors->first() }}', confirmButtonColor: '#e11d48', customClass: { popup: 'rounded-2xl' } });
        @endif
    </script>
@endsection