@extends('themes.islam.layouts.app')

@section('content')

    <section class="py-12 px-4 bg-[#f4f2e9]/50">
        <div class="max-w-3xl mx-auto">
            
            <div class="mb-10 bg-white rounded-2xl border border-emerald-900/5 p-5 shadow-sm flex justify-between items-center text-xs font-bold relative">
                <div id="stepBadg1" class="flex flex-col sm:flex-row items-center gap-2 text-emerald-950 z-10">
                    <span id="stepNum1" class="w-8 h-8 rounded-xl bg-emerald-900 text-amber-400 flex items-center justify-center border border-amber-400/40 font-serif font-bold shadow">١</span>
                    <span class="font-serif">Data Calon Santri</span>
                </div>
                <div class="h-0.5 bg-emerald-900/10 grow mx-4 hidden sm:block"></div>
                <div id="stepBadg2" class="flex flex-col sm:flex-row items-center gap-2 text-gray-400 z-10">
                    <span id="stepNum2" class="w-8 h-8 rounded-xl bg-gray-200 text-gray-600 flex items-center justify-center font-serif font-bold">٢</span>
                    <span class="font-serif">Data Orang Tua / Wali</span>
                </div>
                <div class="h-0.5 bg-emerald-900/10 grow mx-4 hidden sm:block"></div>
                <div id="stepBadg3" class="flex flex-col sm:flex-row items-center gap-2 text-gray-400 z-10">
                    <span id="stepNum3" class="w-8 h-8 rounded-xl bg-gray-200 text-gray-600 flex items-center justify-center font-serif font-bold">٣</span>
                    <span class="font-serif">Berkas Syarat</span>
                </div>
            </div>

            <form id="islamicPpdbForm" action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-emerald-900/5 shadow-md overflow-hidden">
                @csrf
                
                <div id="formSection1" class="p-6 md:p-8 space-y-5">
                    <div class="border-b border-emerald-900/10 pb-3">
                        <h3 class="font-serif text-base font-bold text-emerald-950">Langkah 1: Identitas Calon Santri / Santriwati</h3>
                        <p class="text-xs text-gray-400 font-light mt-0.5">Harap masukkan identitas calon santri secara valid sesuai Akta kelahiran resmi.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-emerald-950 mb-1.5">Nama Lengkap Santri *</label>
                            <input type="text" id="input_nama_santri" name="nama_santri" value="{{ old('nama_santri') }}" placeholder="Contoh: Ahmad Baihaqi" class="w-full text-xs border border-emerald-900/10 rounded-xl p-3 bg-[#fcfbf7] focus:outline-none focus:border-amber-500 focus:bg-white shadow-inner transition text-slate-800 font-medium">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-emerald-950 mb-1.5">Marhalah / Pilihan Jenjang *</label>
                            <select id="input_jenjang" name="jenjang" class="w-full text-xs border border-emerald-900/10 rounded-xl p-3 bg-[#fcfbf7] focus:outline-none focus:border-amber-500 focus:bg-white shadow-inner transition cursor-pointer text-slate-700 font-medium">
                                <option value="">-- Pilih Jenjang Lembaga --</option>
                                <option value="MTs" {{ old('jenjang') == 'MTs' ? 'selected' : '' }}>Madrasah Tsanawiyah (MTs)</option>
                                <option value="MA" {{ old('jenjang') == 'MA' ? 'selected' : '' }}>Madrasah Aliyah (MA)</option>
                                <option value="Tahfidz" {{ old('jenjang') == 'Tahfidz' ? 'selected' : '' }}>Tahfidzul Qur'an (Asrama Pusat)</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-emerald-950 mb-1.5">Jenis Kelamin *</label>
                            <select id="input_jenis_kelamin" name="jenis_kelamin" class="w-full text-xs border border-emerald-900/10 rounded-xl p-3 bg-[#fcfbf7] focus:outline-none focus:border-amber-500 focus:bg-white shadow-inner transition cursor-pointer text-slate-700 font-medium">
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki (Santri)</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan (Santriwati)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-emerald-950 mb-1.5">Asal Daerah (Kabupaten/Kota) *</label>
                            <input type="text" id="input_asal_daerah" name="asal_daerah" value="{{ old('asal_daerah') }}" placeholder="Contoh: Makassar" class="w-full text-xs border border-emerald-900/10 rounded-xl p-3 bg-[#fcfbf7] focus:outline-none focus:border-amber-500 focus:bg-white shadow-inner transition text-slate-800 font-medium">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-emerald-950 mb-1.5">Tanggal Lahir *</label>
                            <input type="date" id="input_tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="w-full text-xs border border-emerald-900/10 rounded-xl p-3 bg-[#fcfbf7] focus:outline-none focus:border-amber-500 focus:bg-white shadow-inner transition cursor-pointer text-slate-700 font-medium">
                        </div>
                    </div>
                </div>

                <div id="formSection2" class="p-6 md:p-8 space-y-5 hidden">
                    <div class="border-b border-emerald-900/10 pb-3">
                        <h3 class="font-serif text-base font-bold text-emerald-950">Langkah 2: Data Nasab Orang Tua / Wali</h3>
                        <p class="text-xs text-gray-400 font-light mt-0.5">Informasi penanggung jawab santri guna koordinasi administrasi berkas kelulusan.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-emerald-950 mb-1.5">Nama Lengkap Orang Tua / Wali *</label>
                            <input type="text" id="input_nama_wali" name="nama_wali" value="{{ old('nama_wali') }}" placeholder="Nama wali penanggung jawab sesuai KK" class="w-full text-xs border border-emerald-900/10 rounded-xl p-3 bg-[#fcfbf7] focus:outline-none focus:border-amber-500 focus:bg-white shadow-inner transition text-slate-800 font-medium">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-emerald-950 mb-1.5">No. Kontak WhatsApp Utama *</label>
                            <input type="tel" id="input_kontak_wali" name="kontak_wali" value="{{ old('kontak_wali') }}" placeholder="Contoh: 08123456xxxx" class="w-full text-xs border border-emerald-900/10 rounded-xl p-3 bg-[#fcfbf7] focus:outline-none focus:border-amber-500 focus:bg-white shadow-inner transition text-slate-800 font-medium">
                            <span class="text-[10px] text-gray-400 font-light block mt-1">Gunakan nomor aktif untuk pemantauan verifikasi panitia.</span>
                        </div>
                        <div class="sm:col-span-2 mt-4">
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Alamat Email Wali (Aktif) *</label>
                            <input type="email" id="email_wali" name="email_wali" value="{{ old('email_wali') }}" placeholder="Contoh: wali@email.com" class="w-full text-xs border border-gray-200 rounded-lg p-3 bg-gray-50 focus:outline-none focus:border-emerald-600 focus:bg-white transition font-medium text-slate-800">
                            <span class="text-[10px] text-gray-400 block mt-1">Sistem akan mengirimkan bukti registrasi dan pengumuman seleksi ke email ini.</span>
                        </div>
                    </div>
                </div>

                <div id="formSection3" class="p-6 md:p-8 space-y-5 hidden">
                    <div class="border-b border-emerald-900/10 pb-3">
                        <h3 class="font-serif text-base font-bold text-emerald-950">Langkah 3: Unggah Berkas Lampiran Syarat</h3>
                        <p class="text-xs text-rose-600 font-medium mt-0.5">Ekstensi valid: .PDF, .JPG, .JPEG, atau .PNG (Kapasitas batas berkas MAKSIMAL 1 MegaByte).</p>
                    </div>

                    <div class="space-y-4">
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 items-center border-b border-gray-100 pb-3">
                            <label class="block text-xs font-bold text-emerald-950 mb-1 sm:mb-0">Salinan Kartu Keluarga (KK) *</label>
                            <div class="sm:col-span-2">
                                <input type="file" id="input_berkas_kk" name="berkas_kk" accept=".pdf,.jpg,.jpeg,.png" class="text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-900 file:text-amber-400 hover:file:bg-emerald-800 cursor-pointer transition">
                                <span id="error_kk" class="text-[11px] text-rose-600 font-medium block mt-1 hidden">Ukuran berkas KK melebihi 1 MB!</span>
                            </div>
                        </div>

                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 items-center border-b border-gray-100 pb-3">
                            <label class="block text-xs font-bold text-emerald-950 mb-1 sm:mb-0">Salinan Akta Kelahiran *</label>
                            <div class="sm:col-span-2">
                                <input type="file" id="input_berkas_akta" name="berkas_akta" accept=".pdf,.jpg,.jpeg,.png" class="text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-900 file:text-amber-400 hover:file:bg-emerald-800 cursor-pointer transition">
                                <span id="error_akta" class="text-[11px] text-rose-600 font-medium block mt-1 hidden">Ukuran berkas Akta melebihi 1 MB!</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 bg-amber-50 rounded-2xl border border-amber-500/20 text-xs text-amber-950 flex gap-3 mt-4">
                        <input type="checkbox" id="checkIkrar" name="ikrar" value="1" class="mt-0.5 shrink-0 rounded text-emerald-900 focus:ring-amber-500 border-emerald-900/20 cursor-pointer">
                        <label for="checkIkrar" class="leading-relaxed font-light cursor-pointer">Demi memegang amanah, saya menyatakan bahwa seluruh rincian data yang diinput dan berkas lampiran yang diunggah adalah sah, benar, dan sesuai aslinya tanpa ada manipulasi.</label>
                    </div>
                </div>

                <div class="bg-[#fcfbf7] border-t border-emerald-900/5 px-6 py-4 flex justify-between items-center">
                    <button type="button" id="btnBack" onclick="navigateIslamicStep(-1)" class="invisible bg-white hover:bg-gray-100 text-emerald-950 text-xs font-bold px-4 py-2.5 rounded-xl border border-emerald-900/10 transition shadow-sm">
                        <i class="fa-solid fa-arrow-left-long mr-1.5"></i> Kembali
                    </button>

                    <button type="button" id="btnNext" onclick="navigateIslamicStep(1)" class="bg-emerald-900 hover:bg-emerald-800 text-amber-300 border border-amber-500/20 text-xs font-bold px-6 py-2.5 rounded-xl shadow-md transition tracking-wide">
                        Lanjutkan <i class="fa-solid fa-arrow-right-long ml-1.5"></i>
                    </button>
                </div>

            </form>
        </div>
    </section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let currentIslamicStep = 1;
        const MAX_FILE_SIZE = 1 * 1024 * 1024; // 1 MB (Bytes)

        // Realtime checking saat user memilih berkas
        document.getElementById('input_berkas_kk').addEventListener('change', function() {
            const errSpan = document.getElementById('error_kk');
            if (this.files[0] && this.files[0].size > MAX_FILE_SIZE) {
                errSpan.classList.remove('hidden');
            } else {
                errSpan.classList.add('hidden');
            }
        });

        document.getElementById('input_berkas_akta').addEventListener('change', function() {
            const errSpan = document.getElementById('error_akta');
            if (this.files[0] && this.files[0].size > MAX_FILE_SIZE) {
                errSpan.classList.remove('hidden');
            } else {
                errSpan.classList.add('hidden');
            }
        });

        function navigateIslamicStep(direction) {
            if (direction === 1) {
                if (currentIslamicStep === 1) {
                    if (!document.getElementById('input_nama_santri').value || !document.getElementById('input_jenjang').value || !document.getElementById('input_asal_daerah').value || !document.getElementById('input_tanggal_lahir').value) {
                        Swal.fire({ icon: 'warning', title: 'Data Belum Lengkap', text: 'Harap lengkapi seluruh kolom identitas bertanda (*) terlebih dahulu.', confirmButtonColor: '#064e3b', customClass: { popup: 'rounded-2xl' } });
                        return;
                    }
                } else if (currentIslamicStep === 2) {
                    const emailInput = document.getElementById('email_wali').value;
                    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                    if (!document.getElementById('input_nama_wali').value || !document.getElementById('input_kontak_wali').value || !emailInput) {
                        Swal.fire({ icon: 'warning', title: 'Data Belum Lengkap', text: 'Harap lengkapi nama wali, nomor WhatsApp, dan Alamat Email Aktif.', confirmButtonColor: '#064e3b', customClass: { popup: 'rounded-2xl' } });
                        return;
                    }
                    
                    if (!emailPattern.test(emailInput)) {
                        Swal.fire({ icon: 'error', title: 'Format Email Salah', text: 'Pastikan email ditulis dengan benar (contoh: ayah@email.com).', confirmButtonColor: '#e11d48', customClass: { popup: 'rounded-2xl' } });
                        return;
                    }
                } else if (currentIslamicStep === 3) {
                    const berkasKK = document.getElementById('input_berkas_kk');
                    const berkasAkta = document.getElementById('input_berkas_akta');

                    if (!berkasKK.value || !berkasAkta.value) {
                        Swal.fire({ icon: 'warning', title: 'Berkas Kosong', text: 'Kedua berkas dokumen syarat (KK & Akta) wajib dilampirkan.', confirmButtonColor: '#064e3b', customClass: { popup: 'rounded-2xl' } });
                        return;
                    }

                    // BLOKIR UKURAN FILE SISI KLIEN SEBELUM SUBMIT
                    if (berkasKK.files[0].size > MAX_FILE_SIZE) {
                        Swal.fire({ icon: 'error', title: 'Berkas KK Ditolak', text: 'Ukuran file Kartu Keluarga Anda melebihi batas 1 Megabyte. Transaksi dibatalkan. Harap kompres file terlebih dahulu.', confirmButtonColor: '#e11d48', customClass: { popup: 'rounded-2xl' } });
                        return;
                    }

                    if (berkasAkta.files[0].size > MAX_FILE_SIZE) {
                        Swal.fire({ icon: 'error', title: 'Berkas Akta Ditolak', text: 'Ukuran file Akta Kelahiran Anda melebihi batas 1 Megabyte. Transaksi dibatalkan. Harap kompres file terlebih dahulu.', confirmButtonColor: '#e11d48', customClass: { popup: 'rounded-2xl' } });
                        return;
                    }

                    if (!document.getElementById('checkIkrar').checked) {
                        Swal.fire({ icon: 'warning', title: 'Ikrar Belum Disetujui', text: 'Anda wajib menyetujui pernyataan amanah pertanggungjawaban data.', confirmButtonColor: '#064e3b', customClass: { popup: 'rounded-2xl' } });
                        return;
                    }
                    
                    Swal.fire({
                        title: 'Memproses Pendaftaran',
                        html: 'Data sedang diunggah dan dikirim ke email Anda. Mohon tunggu...',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => { Swal.showLoading(); },
                        customClass: { popup: 'rounded-2xl' }
                    });

                    document.getElementById('islamicPpdbForm').submit();
                    return;
                }
            }

            // Atur perpindahan variabel tahap langkah
            currentIslamicStep += direction;

            // Render Tampilan Elemen HTML
            document.getElementById('formSection1').classList.add('hidden');
            document.getElementById('formSection2').classList.add('hidden');
            document.getElementById('formSection3').classList.add('hidden');
            
            document.getElementById(`formSection${currentIslamicStep}`).classList.remove('hidden');

            // Sinkronisasi Desain Indikator
            for (let i = 1; i <= 3; i++) {
                const num = document.getElementById(`stepNum${i}`);
                if (i <= currentIslamicStep) {
                    num.className = "w-8 h-8 rounded-xl bg-emerald-900 text-amber-400 flex items-center justify-center border border-amber-400/40 font-serif font-bold shadow";
                } else {
                    num.className = "w-8 h-8 rounded-xl bg-gray-200 text-gray-600 flex items-center justify-center font-serif font-bold";
                }
            }

            // Kontrol tombol aksi bawah
            const btnBack = document.getElementById('btnBack');
            const btnNext = document.getElementById('btnNext');

            if (currentIslamicStep === 1) {
                btnBack.classList.add('invisible');
                btnNext.innerHTML = 'Lanjutkan <i class="fa-solid fa-arrow-right-long ml-1.5"></i>';
                btnNext.className = "bg-emerald-900 hover:bg-emerald-800 text-amber-300 border border-amber-500/20 text-xs font-bold px-6 py-2.5 rounded-xl shadow-md transition";
            } else if (currentIslamicStep === 2) {
                btnBack.classList.remove('invisible');
                btnNext.innerHTML = 'Lanjutkan <i class="fa-solid fa-arrow-right-long ml-1.5"></i>';
                btnNext.className = "bg-emerald-900 hover:bg-emerald-800 text-amber-300 border border-amber-500/20 text-xs font-bold px-6 py-2.5 rounded-xl shadow-md transition";
            } else if (currentIslamicStep === 3) {
                btnBack.classList.remove('invisible');
                btnNext.innerHTML = '<i class="fa-solid fa-paper-plane mr-1.5"></i> Ajukan Formulir PPDB';
                btnNext.className = "bg-amber-500 hover:bg-amber-600 text-emerald-950 text-xs font-black px-6 py-2.5 rounded-xl shadow-lg border border-amber-400 transition";
            }
        }

        // POP-UP NOTIFIKASI BERHASIL (Satu buah gabungan)
        @if(session('success_ppdb'))
            Swal.fire({
                icon: 'success',
                title: 'Pendaftaran Berhasil!',
                html: `<p class="text-sm text-gray-600 leading-relaxed">Formulir ajuan santri baru berhasil terekam ke database sekretariat pesantren.</p>
                       <p class="mt-2 text-sm text-gray-600">Nomor Registrasi Anda:</p>
                       <span class="text-lg font-mono font-bold text-emerald-700 bg-emerald-50 px-4 py-2 rounded-xl block mt-2 mb-3 border border-emerald-100">{{ session('success_ppdb') }}</span>
                       <p class="text-sm text-amber-600 font-bold bg-amber-50 p-2 rounded-lg">PENTING: Silakan cek Kotak Masuk atau folder Spam di email Anda untuk melihat bukti pendaftaran resmi.</p>`,
                confirmButtonColor: '#10b981',
                confirmButtonText: 'Tutup',
                customClass: { popup: 'rounded-2xl' }
            });
        @endif

        // NOTIFIKASI ERROR SYSTEM (Termasuk kegagalan pengiriman email/rollBack)
        @if(session('error') || $errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Transaksi Gagal!',
                text: '{{ session("error") ?: $errors->first() }}',
                confirmButtonColor: '#e11d48',
                customClass: { popup: 'rounded-2xl' }
            });
        @endif
    </script>
@endsection