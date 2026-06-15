@extends('admin.layouts.app') @section('content')
<div class="p-6 max-w-4xl mx-auto">
    <div class="mb-6">
        <h1 class="text-xl font-serif font-bold text-emerald-950">Pengaturan Konten Publik</h1>
        <p class="text-xs text-gray-500">Kelola informasi Sambutan, Sejarah, Visi Misi, dan Struktur Organisasi yang tampil pada halaman depan.</p>
    </div>

    <form id="formUpdateProfil" action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-emerald-900/5 shadow-md overflow-hidden">
        @csrf
        @method('PUT')

        <div class="p-6 space-y-6">
            <div class="border-b border-gray-100 pb-5">
                <h3 class="text-xs font-bold uppercase tracking-wider text-emerald-900 mb-3 font-serif">1. Sambutan Pengasuh Pondok</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                    <label class="block text-xs font-bold text-slate-700">Foto Pengasuh Saat Ini</label>
                    <div class="md:col-span-2 space-y-3">
                        @if(isset($settings['sambutan_foto']))
                            <img src="{{ asset('storage/' . $settings['sambutan_foto']) }}" alt="Foto Pengasuh" class="w-32 h-40 object-cover rounded-xl border border-emerald-900/10 shadow-sm">
                        @else
                            <div class="w-32 h-40 bg-gray-100 rounded-xl flex items-center justify-center text-[10px] text-gray-400">Belum ada foto</div>
                        @endif
                        <input type="file" id="input_sambutan_foto" name="sambutan_foto" accept=".jpg,.jpeg,.png" class="text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-900 file:text-amber-400 hover:file:bg-emerald-800 cursor-pointer transition">
                        <span class="text-[10px] text-gray-400 block">Format: JPG/PNG. Maksimal 1 MB.</span>
                        <span id="error_sambutan" class="text-[11px] text-rose-600 font-medium block hidden">Ukuran berkas melebihi 1 MB!</span>
                    </div>
                </div>
            </div>

            <div class="border-b border-gray-100 pb-5">
                <h3 class="text-xs font-bold uppercase tracking-wider text-emerald-900 mb-3 font-serif">2. Sejarah Berdirinya Ma'had</h3>
                <div class="space-y-2">
                    <label class="block text-xs font-bold text-slate-700">Teks Sejarah Singkat / Lengkap</label>
                    <textarea name="sejarah_teks" rows="6" class="w-full text-xs border border-emerald-900/10 rounded-xl p-3 bg-[#fcfbf7] focus:outline-none focus:border-amber-500 focus:bg-white shadow-inner transition text-slate-800 leading-relaxed" placeholder="Tuliskan sejarah berdirinya pondok pesantren disini...">{{ $settings['sejarah_teks'] ?? '' }}</textarea>
                </div>
            </div>

            <div class="border-b border-gray-100 pb-5">
                <h3 class="text-xs font-bold uppercase tracking-wider text-emerald-900 mb-3 font-serif">3. Visi & Misi</h3>
                <div class="space-y-2">
                    <label class="block text-xs font-bold text-slate-700">Teks Visi & Jabaran Misi</label>
                    <textarea name="visi_misi_teks" rows="6" class="w-full text-xs border border-emerald-900/10 rounded-xl p-3 bg-[#fcfbf7] focus:outline-none focus:border-amber-500 focus:bg-white shadow-inner transition text-slate-800 leading-relaxed" placeholder="Contoh:&#10;Visi: Menjadi lembaga...&#10;Misi:&#10;1. Menyelenggarakan...&#10;2. Membina...">{{ $settings['visi_misi_teks'] ?? '' }}</textarea>
                </div>
            </div>

            <div class="pb-3">
                <h3 class="text-xs font-bold uppercase tracking-wider text-emerald-900 mb-3 font-serif">4. Bagan Struktur Pengurus</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                    <label class="block text-xs font-bold text-slate-700">Gambar Bagan Struktur</label>
                    <div class="md:col-span-2 space-y-3">
                        @if(isset($settings['struktur_pengurus']))
                            <img src="{{ asset('storage/' . $settings['struktur_pengurus']) }}" alt="Struktur Pengurus" class="w-full max-w-md h-auto object-contain rounded-xl border border-emerald-900/10 shadow-sm">
                        @else
                            <div class="w-48 h-32 bg-gray-100 rounded-xl flex items-center justify-center text-[10px] text-gray-400">Belum ada bagan diupload</div>
                        @endif
                        <input type="file" id="input_struktur_pengurus" name="struktur_pengurus" accept=".jpg,.jpeg,.png" class="text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-900 file:text-amber-400 hover:file:bg-emerald-800 cursor-pointer transition">
                        <span class="text-[10px] text-gray-400 block">Format: JPG/PNG/JPEG. Ukuran infografis disarankan landscape (Maks 1 MB).</span>
                        <span id="error_struktur" class="text-[11px] text-rose-600 font-medium block hidden">Ukuran berkas bagan melebihi 1 MB!</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-[#fcfbf7] border-t border-emerald-900/5 px-6 py-4 flex justify-end">
            <button type="submit" class="bg-emerald-900 hover:bg-emerald-800 text-amber-300 border border-amber-500/20 text-xs font-bold px-6 py-2.5 rounded-xl shadow-md transition">
                <i class="fa-solid fa-floppy-disk mr-1.5"></i> Simpan Seluruh Perubahan
            </button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const MAX_SIZE = 1 * 1024 * 1024; // 1 MB dalam Hitungan Bytes

    // Realtime Check File Sambutan
    document.getElementById('input_sambutan_foto').addEventListener('change', function() {
        const error = document.getElementById('error_sambutan');
        if (this.files[0] && this.files[0].size > MAX_SIZE) {
            error.classList.remove('hidden');
        } else {
            error.classList.add('hidden');
        }
    });

    // Realtime Check File Struktur
    document.getElementById('input_struktur_pengurus').addEventListener('change', function() {
        const error = document.getElementById('error_struktur');
        if (this.files[0] && this.files[0].size > MAX_SIZE) {
            error.classList.remove('hidden');
        } else {
            error.classList.add('hidden');
        }
    });

    // Intercept submit form untuk validasi akhir & animasi loading
    document.getElementById('formUpdateProfil').addEventListener('submit', function(e) {
        e.preventDefault();

        const fileSambutan = document.getElementById('input_sambutan_foto');
        const fileStruktur = document.getElementById('input_struktur_pengurus');

        if (fileSambutan.files[0] && fileSambutan.files[0].size > MAX_SIZE) {
            Swal.fire({ icon: 'error', title: 'File Terlalu Besar', text: 'Foto Sambutan Pengasuh melebihi kapasitas 1 MB.', confirmButtonColor: '#e11d48', customClass: { popup: 'rounded-2xl' } });
            return;
        }

        if (fileStruktur.files[0] && fileStruktur.files[0].size > MAX_SIZE) {
            Swal.fire({ icon: 'error', title: 'File Terlalu Besar', text: 'Gambar Bagan Struktur Pengurus melebihi kapasitas 1 MB.', confirmButtonColor: '#e11d48', customClass: { popup: 'rounded-2xl' } });
            return;
        }

        // Jalankan Efek Loading Proses Upload
        Swal.fire({
            title: 'Menyimpan Perubahan',
            html: 'Mohon tunggu, sistem sedang memproses pembaruan teks dan berkas gambar...',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
            didOpen: () => {
                Swal.showLoading();
            },
            customClass: { popup: 'rounded-2xl' }
        });

        this.submit(); // Teruskan pengiriman asli
    });

    // Pop-up Notifikasi Sukses
    @if(session('success_update'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil Diperbarui!',
            text: '{{ session("success_update") }}',
            confirmButtonColor: '#10b981',
            customClass: { popup: 'rounded-2xl' }
        });
    @endif

    // Pop-up Notifikasi Error Validasi Laravel Backend
    @if($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Gagal Menyimpan!',
            text: '{{ $errors->first() }}',
            confirmButtonColor: '#e11d48',
            customClass: { popup: 'rounded-2xl' }
        });
    @endif
</script>
@endsection