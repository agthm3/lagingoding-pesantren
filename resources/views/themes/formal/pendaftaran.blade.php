@extends('themes.formal.layouts.app')

@section('content')
    <!-- Formulir Pendaftaran PPDB Utama -->
    <section class="py-12 px-4 bg-gray-50">
        <div class="max-w-3xl mx-auto">
            
            <!-- Indikator Alur Langkah (Step Indicator Component) -->
            <div class="mb-10 bg-white rounded-xl border border-gray-100 p-4 shadow-sm flex justify-between items-center text-xs font-semibold relative">
                <!-- Step 1 -->
                <div id="stepBadg1" class="flex flex-col sm:flex-row items-center gap-2 text-emerald-800 z-10 transition">
                    <span id="stepNum1" class="w-7 h-7 rounded-full bg-emerald-700 text-white flex items-center justify-center font-bold shadow-sm">1</span>
                    <span class="hidden sm:inline">Data Santri</span>
                </div>
                <div id="line1" class="h-0.5 bg-gray-200 grow mx-4 hidden sm:block transition"></div>
                <!-- Step 2 -->
                <div id="stepBadg2" class="flex flex-col sm:flex-row items-center gap-2 text-gray-400 z-10 transition">
                    <span id="stepNum2" class="w-7 h-7 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center font-bold">2</span>
                    <span class="hidden sm:inline">Orang Tua/Wali</span>
                </div>
                <div id="line2" class="h-0.5 bg-gray-200 grow mx-4 hidden sm:block transition"></div>
                <!-- Step 3 -->
                <div id="stepBadg3" class="flex flex-col sm:flex-row items-center gap-2 text-gray-400 z-10 transition">
                    <span id="stepNum3" class="w-7 h-7 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center font-bold">3</span>
                    <span class="hidden sm:inline">Upload Berkas</span>
                </div>
            </div>

            <!-- Kontainer Utama Form Terhubung Backend -->
            <form id="ppdbForm" action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                @csrf
                
                <!-- STEP 1: DATA CALON SANTRI -->
                <div id="formSection1" class="p-6 md:p-8 space-y-5">
                    <div class="border-b border-gray-100 pb-3">
                        <h3 class="text-base font-bold text-gray-900 tracking-tight">Langkah 1: Identitas Calon Santri</h3>
                        <p class="text-xs text-gray-400 mt-0.5">Isi data pribadi calon santri sesuai dengan dokumen asli.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Nama Lengkap Calon Santri *</label>
                            <input type="text" name="nama_santri" value="{{ old('nama_santri') }}" placeholder="Contoh: Muhammad Akhyar" class="w-full text-xs border border-gray-200 rounded-lg p-3 bg-gray-50 focus:outline-none focus:border-emerald-600 focus:bg-white transition font-medium text-slate-800">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Jenjang Pendidikan Pilihan *</label>
                            <select name="jenjang" class="w-full text-xs border border-gray-200 rounded-lg p-3 bg-gray-50 focus:outline-none focus:border-emerald-600 focus:bg-white transition font-medium text-slate-800">
                                <option value="">-- Pilih Jenjang --</option>
                                <option value="MTs" {{ old('jenjang') == 'MTs' ? 'selected' : '' }}>Madrasah Tsanawiyah (MTs)</option>
                                <option value="MA" {{ old('jenjang') == 'MA' ? 'selected' : '' }}>Madrasah Aliyah (MA)</option>
                                <option value="Tahfidz" {{ old('jenjang') == 'Tahfidz' ? 'selected' : '' }}>Tahfidzul Qur'an (Unggulan)</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Jenis Kelamin *</label>
                            <select name="jenis_kelamin" class="w-full text-xs border border-gray-200 rounded-lg p-3 bg-gray-50 focus:outline-none focus:border-emerald-600 focus:bg-white transition font-medium text-slate-800">
                                <option value="">-- Pilih --</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki (Santri)</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan (Santriwati)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Asal Daerah (Kabupaten/Kota) *</label>
                            <input type="text" name="asal_daerah" value="{{ old('asal_daerah') }}" placeholder="Contoh: Makassar" class="w-full text-xs border border-gray-200 rounded-lg p-3 bg-gray-50 focus:outline-none focus:border-emerald-600 focus:bg-white transition font-medium text-slate-800">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Tanggal Lahir *</label>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="w-full text-xs border border-gray-200 rounded-lg p-3 bg-gray-50 focus:outline-none focus:border-emerald-600 focus:bg-white transition font-medium text-slate-800">
                        </div>
                    </div>
                </div>

                <!-- STEP 2: DATA ORANG TUA / WALI -->
                <div id="formSection2" class="p-6 md:p-8 space-y-5 hidden">
                    <div class="border-b border-gray-100 pb-3">
                        <h3 class="text-base font-bold text-gray-900 tracking-tight">Langkah 2: Data Orang Tua / Wali</h3>
                        <p class="text-xs text-gray-400 mt-0.5">Informasi kontak guna peninjauan berkas administrasi.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Nama Lengkap Orang Tua / Wali *</label>
                            <input type="text" id="nama_wali" name="nama_wali" value="{{ old('nama_wali') }}" placeholder="Nama wali penanggung jawab" class="w-full text-xs border border-gray-200 rounded-lg p-3 bg-gray-50 focus:outline-none focus:border-emerald-600 focus:bg-white transition font-medium text-slate-800">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Nomor WhatsApp Aktif Wali *</label>
                            <input type="tel" id="kontak_wali" name="kontak_wali" value="{{ old('kontak_wali') }}" placeholder="Contoh: 081234567xxx" class="w-full text-xs border border-gray-200 rounded-lg p-3 bg-gray-50 focus:outline-none focus:border-emerald-600 focus:bg-white transition font-medium text-slate-800">
                            <span class="text-[10px] text-gray-400 block mt-1">Sistem akan mencatat kontak ini untuk koordinasi wawancara fisik.</span>
                        </div>
                    </div>
                </div>

                <!-- STEP 3: UPLOAD BERKAS -->
                <div id="formSection3" class="p-6 md:p-8 space-y-5 hidden">
                    <div class="border-b border-gray-100 pb-3">
                        <h3 class="text-base font-bold text-gray-900 tracking-tight">Langkah 3: Unggah Berkas Persyaratan</h3>
                        <p class="text-xs text-gray-400 mt-0.5">Format file diperbolehkan: .JPG, .PNG, atau .PDF dengan kapasitas maksimal 1MB per berkas.</p>
                    </div>

                    <div class="space-y-4">
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 items-center border-b border-gray-100 pb-3">
                            <label class="block text-xs font-semibold text-gray-700 mb-1 sm:mb-0">Scan Kartu Keluarga (KK) *</label>
                            <div class="sm:col-span-2">
                                <input type="file" name="berkas_kk" accept=".pdf,.jpg,.jpeg,.png" class="text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                            </div>
                        </div>

                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 items-center border-b border-gray-100 pb-3">
                            <label class="block text-xs font-semibold text-gray-700 mb-1 sm:mb-0">Scan Akta Kelahiran *</label>
                            <div class="sm:col-span-2">
                                <input type="file" name="berkas_akta" accept=".pdf,.jpg,.jpeg,.png" class="text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                            </div>
                        </div>
                    </div>

                    <!-- Syarat Centang Konfirmasi Keaslian Data -->
                    <div class="p-4 bg-amber-50 border border-amber-100 rounded-xl text-xs text-amber-900 flex gap-3 mt-4">
                        <input type="checkbox" name="ikrar" value="1" id="ikrar" {{ old('ikrar') ? 'checked' : '' }} class="mt-0.5 shrink-0 rounded text-emerald-700 focus:ring-emerald-600 cursor-pointer">
                        <label for="ikrar" class="leading-relaxed select-none cursor-pointer">Saya menyatakan dengan sebenar-benarnya bahwa seluruh data yang diinput dan berkas yang diunggah adalah sah, benar, dan sesuai dengan dokumen asli.</label>
                    </div>
                </div>

                <!-- PANEL TOMBOL NAVIGASI FORM -->
                <div class="bg-gray-50 border-t border-gray-100 px-6 py-4 flex justify-between items-center">
                    <button type="button" id="btnBack" class="bg-white hover:bg-gray-100 text-gray-700 text-xs font-semibold px-4 py-2.5 rounded border border-gray-200 transition focus:outline-none shadow-sm hidden">
                        <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
                    </button>

                    <button type="button" id="btnNext" class="bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold px-6 py-2.5 rounded shadow transition focus:outline-none ml-auto">
                        Lanjutkan <i class="fa-solid fa-arrow-right ml-1"></i>
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- INJEKSI SCRIPT POP-UP MANAGEMENT & MULTI-STEP LOGIC -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let currentStep = 1;

        const btnNext = document.getElementById('btnNext');
        const btnBack = document.getElementById('btnBack');
        const form = document.getElementById('ppdbForm');

        function updateStepUI() {
            // Sembunyikan semua seksi form
            document.getElementById('formSection1').classList.add('hidden');
            document.getElementById('formSection2').classList.add('hidden');
            document.getElementById('formSection3').classList.add('hidden');

            // Munculkan seksi langkah aktif
            document.getElementById(`formSection${currentStep}`).classList.remove('hidden');

            // Kontrol visibilitas tombol back
            if (currentStep === 1) {
                btnBack.classList.add('hidden');
            } else {
                btnBack.classList.remove('hidden');
            }

            // Ubah teks tombol langkah terakhir
            if (currentStep === 3) {
                btnNext.innerHTML = `<i class="fa-solid fa-cloud-arrow-up mr-1"></i> Kirim Formulir`;
                btnNext.className = "bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold px-6 py-2.5 rounded shadow transition focus:outline-none";
            } else {
                btnNext.innerHTML = `Lanjutkan <i class="fa-solid fa-arrow-right ml-1"></i>`;
                btnNext.className = "bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold px-6 py-2.5 rounded shadow transition focus:outline-none";
            }

            // Update warna indikator lingkaran langkah atas
            for (let i = 1; i <= 3; i++) {
                const badge = document.getElementById(`stepBadg${i}`);
                const num = document.getElementById(`stepNum${i}`);
                const line = document.getElementById(`line${i - 1}`);

                if (i <= currentStep) {
                    badge.className = "flex flex-col sm:flex-row items-center gap-2 text-emerald-800 z-10";
                    num.className = "w-7 h-7 rounded-full bg-emerald-700 text-white flex items-center justify-center font-bold shadow-sm";
                    if (line) line.classList.replace('bg-gray-200', 'bg-emerald-700');
                } else {
                    badge.className = "flex flex-col sm:flex-row items-center gap-2 text-gray-400 z-10";
                    num.className = "w-7 h-7 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center font-bold";
                    if (line) line.classList.replace('bg-emerald-700', 'bg-gray-200');
                }
            }
        }

        btnNext.addEventListener('click', function () {
            // Validasi Inputan Sederhana Sebelum Melangkah
            if (currentStep === 1) {
                const nama = document.getElementsByName('nama_santri')[0].value;
                const jenjang = document.getElementsByName('jenjang')[0].value;
                const jk = document.getElementsByName('jenis_kelamin')[0].value;
                const asal = document.getElementsByName('asal_daerah')[0].value;
                const tgl = document.getElementsByName('tanggal_lahir')[0].value;

                if (!nama || !jenjang || !jk || !asal || !tgl) {
                    Swal.fire({ icon: 'warning', title: 'Data Belum Lengkap', text: 'Mohon lengkapi seluruh kolom isian bertanda bintang (*) langkah kesatu.', confirmButtonColor: '#b45309' });
                    return;
                }
                currentStep = 2;
                updateStepUI();
            } else if (currentStep === 2) {
                const wali = document.getElementById('nama_wali').value;
                const kontak = document.getElementById('kontak_wali').value;

                if (!wali || !kontak) {
                    Swal.fire({ icon: 'warning', title: 'Data Belum Lengkap', text: 'Mohon isi nama wali serta nomor sambungan WhatsApp aktif Anda.', confirmButtonColor: '#b45309' });
                    return;
                }
                currentStep = 3;
                updateStepUI();
            } else if (currentStep === 3) {
                // 1. VALIDASI UKURAN FILE MAKSIMAL 1 MB (DI SINI PROSES CEGAHNYA)
                const fileKK = document.getElementsByName('berkas_kk')[0];
                const fileAkta = document.getElementsByName('berkas_akta')[0];
                const maxSize = 1 * 1024 * 1024; // 1 Megabyte dalam satuan Bytes

                // Cek ketersediaan dan ukuran berkas Kartu Keluarga
                if (fileKK.files.length > 0) {
                    if (fileKK.files[0].size > maxSize) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Berkas KK Terlalu Besar',
                            text: 'Ukuran Scan Kartu Keluarga melebihi batas maksimal 1 MB. Mohon kompres file Anda terlebih dahulu.',
                            confirmButtonColor: '#e11d48'
                        });
                        return; // Berhenti di sini, cegah submit form
                    }
                } else {
                    Swal.fire({ icon: 'warning', title: 'Berkas Belum Diunggah', text: 'Scan Kartu Keluarga wajib dilampirkan.', confirmButtonColor: '#b45309' });
                    return;
                }

                // Cek ketersediaan dan ukuran berkas Akta Kelahiran
                if (fileAkta.files.length > 0) {
                    if (fileAkta.files[0].size > maxSize) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Berkas Akta Terlalu Besar',
                            text: 'Ukuran Scan Akta Kelahiran melebihi batas maksimal 1 MB. Mohon kompres file Anda terlebih dahulu.',
                            confirmButtonColor: '#e11d48'
                        });
                        return; // Berhenti di sini, cegah submit form
                    }
                } else {
                    Swal.fire({ icon: 'warning', title: 'Berkas Belum Diunggah', text: 'Scan Akta Kelahiran wajib dilampirkan.', confirmButtonColor: '#b45309' });
                    return;
                }

                // 2. Cek Klausul Ikrar Pertanggungjawaban
                const ikrar = document.getElementById('ikrar').checked;
                if (!ikrar) {
                    Swal.fire({ icon: 'info', title: 'Persetujuan Diperlukan', text: 'Anda wajib mencentang klausul pakta ikrar pertanggungjawaban data.', confirmButtonColor: '#4f46e5' });
                    return;
                }
                
                // Jika lolos semua validasi, eksekusi submit
                Swal.fire({
                    title: 'Memproses Registrasi',
                    html: 'Mohon tunggu, berkas lampiran fisik sedang diunggah dan diamankan ke database server...',
                    allowOutsideClick: false, didOpen: () => { Swal.showLoading(); }
                });
                form.submit();
            }
        });

        btnBack.addEventListener('click', function () {
            if (currentStep > 1) {
                currentStep--;
                updateStepUI();
            }
        });

        // NOTIFIKASI HANDLING SWEETALERT DARI SESSION SERVER BACKEND LARAVEL
        @if(session('success_ppdb'))
            Swal.fire({
                icon: 'success',
                title: 'Pendaftaran Berhasil!',
                html: 'Alhamdulillah, berkas formulir online terunggah.<br><br>Nomor Registrasi Anda:<br><b class="text-xl font-mono text-indigo-600 bg-indigo-50 px-4 py-2 rounded-xl block mt-2 border border-indigo-100 shadow-inner">{{ session('success_ppdb') }}</b><br>Harap simpan nomor ini untuk verifikasi fisik.',
                confirmButtonColor: '#4f46e5',
                customClass: { popup: 'rounded-2xl' }
            });
        @endif

        @if(session('error') || $errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Gagal Mengirim!',
                text: '{{ session('error') ?: $errors->first() }}',
                confirmButtonColor: '#e11d48',
                customClass: { popup: 'rounded-2xl' }
            });
        @endif
    </script>
@endsection