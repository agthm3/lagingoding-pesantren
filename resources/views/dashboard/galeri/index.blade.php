@extends('layouts.dashboard')

@section('content')
    <main class="grow flex flex-col min-w-0">
        
        <header class="bg-white border-b border-slate-200/60 px-6 py-4 flex justify-between items-center sticky top-0 z-30 shadow-sm shadow-slate-100/50">
            <div class="flex items-center gap-3">
                <button class="md:hidden text-slate-600"><i class="fa-solid fa-bars text-lg"></i></button>
                <h3 class="text-slate-900 font-black text-sm md:text-base tracking-tight">Pusat Manajemen Galeri Dokumentasi</h3>
            </div>
            <div class="text-xs font-bold flex items-center gap-2">
                <button onclick="openUploadModal()" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2.5 rounded-xl transition flex items-center gap-1.5 shadow-sm shadow-indigo-600/10">
                    <i class="fa-solid fa-cloud-arrow-up text-[10px]"></i> Unggah Media Baru
                </button>
            </div>
        </header>

        <div class="p-6 space-y-6 overflow-y-auto grow">
            
            <section class="bg-white border border-slate-200/80 rounded-2xl p-4 shadow-sm flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="flex flex-wrap items-center gap-3 w-full sm:w-auto text-xs font-bold">
                    <form action="{{ route('dashboard.galeri.index') }}" method="GET" id="filterForm">
                        <select name="jenis" onchange="document.getElementById('filterForm').submit()" class="border border-slate-200 bg-slate-50 px-4 py-2.5 rounded-xl text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition cursor-pointer w-full sm:w-auto">
                            <option value="">Semua Tipe Media</option>
                            <option value="foto" {{ $filter_jenis == 'foto' ? 'selected' : '' }}>Foto (.JPG / .PNG)</option>
                            <option value="video" {{ $filter_jenis == 'video' ? 'selected' : '' }}>Video (Tautan YouTube)</option>
                        </select>
                    </form>
                </div>
                <div class="text-[11px] text-slate-400 font-bold self-end sm:self-center">
                    Total Aset Terdata: <span class="text-slate-900">{{ $totalMedia }} File Dokumentasi</span>
                </div>
            </section>

            <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                
                @forelse ($daftar_galeri as $media)
                    @if ($media->jenis === 'foto')
                        <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm flex flex-col justify-between group">
                            <div class="h-40 bg-slate-100 relative border-b border-slate-100 overflow-hidden">
                                <img src="{{ asset('storage/' . $media->konten) }}" alt="Foto" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                <span class="absolute top-3 left-3 bg-slate-900 text-cyan-400 text-[9px] font-bold px-2 py-0.5 rounded uppercase tracking-wider"><i class="fa-regular fa-image mr-1"></i> Foto</span>
                            </div>
                            <div class="p-4 space-y-3">
                                <div>
                                    <h5 class="font-bold text-slate-900 text-xs truncate" title="{{ $media->judul }}">{{ $media->judul }}</h5>
                                    <p class="text-[10px] text-slate-400 font-normal mt-0.5">Diunggah: {{ $media->created_at->translatedFormat('d M Y') }}</p>
                                </div>
                                <div class="border-t border-slate-100 pt-3 flex justify-end">
                                    <button onclick="confirmDelete('{{ $media->id }}')" class="bg-rose-50 hover:bg-rose-100 text-rose-600 border border-rose-200/60 text-[10px] font-bold px-2.5 py-1.5 rounded-lg transition">
                                        <i class="fa-solid fa-trash-can mr-1"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm flex flex-col justify-between group">
                            <div class="h-40 bg-slate-100 relative border-b border-slate-100 overflow-hidden">
                                <img src="https://img.youtube.com/vi/{{ $media->konten }}/mqdefault.jpg" alt="Thumbnail YouTube" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                <div class="absolute inset-0 bg-slate-950/20 flex items-center justify-center">
                                    <i class="fa-brands fa-youtube text-3xl text-white drop-shadow-md"></i>
                                </div>
                                <span class="absolute top-3 left-3 bg-red-600 text-white text-[9px] font-bold px-2 py-0.5 rounded uppercase tracking-wider"><i class="fa-solid fa-play mr-1"></i> Video</span>
                            </div>
                            <div class="p-4 space-y-3">
                                <div>
                                    <h5 class="font-bold text-slate-900 text-xs truncate" title="{{ $media->judul }}">{{ $media->judul }}</h5>
                                    <p class="text-[10px] text-slate-400 font-mono mt-0.5 truncate">ID: {{ $media->konten }}</p>
                                </div>
                                <div class="border-t border-slate-100 pt-3 flex justify-end">
                                    <button onclick="confirmDelete('{{ $media->id }}')" class="bg-rose-50 hover:bg-rose-100 text-rose-600 border border-rose-200/60 text-[10px] font-bold px-2.5 py-1.5 rounded-lg transition">
                                        <i class="fa-solid fa-trash-can mr-1"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Form hidden tunggal untuk eksekusi hapus data --}}
                    <form action="{{ route('dashboard.galeri.destroy', $media->id) }}" method="POST" id="delete-form-{{ $media->id }}" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                @empty
                    <div class="col-span-1 sm:col-span-2 lg:col-span-4 bg-white border border-slate-200 rounded-2xl p-12 text-center text-slate-400 italic font-medium">
                        <i class="fa-regular fa-folder-open text-2xl block mb-2 text-slate-300"></i>
                        Belum ada dokumen media terdaftar untuk kategori ini.
                    </div>
                @endforelse

            </section>
        </div>

        <div id="uploadMediaModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-slate-950 bg-opacity-50 backdrop-blur-sm" onclick="closeUploadModal()"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-2xl shadow-2xl sm:my-8 sm:align-middle sm:max-w-md sm:w-full border border-slate-200 relative z-50">
                    <div class="bg-white px-6 pt-6 pb-4 border-b border-slate-100 flex justify-between items-center">
                        <h4 class="text-sm font-black text-slate-900 tracking-tight">Unggah Aset Dokumentasi Baru</h4>
                        <button onclick="closeUploadModal()" class="text-slate-400 hover:text-slate-600 transition focus:outline-none"><i class="fa-solid fa-xmark text-sm"></i></button>
                    </div>

                    <form action="{{ route('dashboard.galeri.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4 text-xs font-bold">
                        @csrf
                        
                        <div>
                            <label class="block text-slate-700 mb-1.5">Keterangan / Judul Singkat Media *</label>
                            <input type="text" name="judul" value="{{ old('judul') }}" required placeholder="Contoh: Upacara Hari Santri Nasional" class="w-full font-medium border @error('judul') border-red-500 @else border-slate-200 @enderror rounded-xl p-3 bg-slate-50 focus:outline-none focus:border-indigo-500 transition text-slate-900">
                            @error('judul') <span class="text-red-500 text-[10px] block mt-1"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-slate-700 mb-1.5">Jenis Dokumentasi *</label>
                            <select id="mediaTypeSelector" name="jenis" onchange="toggleModalFormInputs()" class="w-full border border-slate-200 bg-slate-50 p-3 rounded-xl text-slate-700 focus:outline-none focus:border-indigo-500 transition cursor-pointer">
                                <option value="image_upload" {{ old('jenis') == 'image_upload' ? 'selected' : '' }}>Berkas Gambar / Foto</option>
                                <option value="video_link" {{ old('jenis') == 'video_link' ? 'selected' : '' }}>Tautan Video YouTube</option>
                            </select>
                        </div>

                        <div id="slotImageUpload" class="space-y-1.5">
                            <label class="block text-slate-700">Pilih File Foto *</label>
                            <input type="file" name="foto" class="w-full text-slate-500 font-medium file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border @error('foto') border-red-500 @else border-slate-200 @enderror file:text-xs file:font-bold file:bg-slate-900 file:text-cyan-400 cursor-pointer transition">
                            @error('foto') <span class="text-red-500 text-[10px] block mt-1"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</span> @enderror
                            <span class="text-[10px] text-slate-400 font-normal block pt-1">Ekstensi valid: .JPG, .JPEG, .PNG, .WEBP. Maksimal 2MB.</span>
                        </div>

                        <div id="slotVideoLink" class="space-y-1.5 hidden">
                            <label class="block text-slate-700">Tautan Share URL YouTube *</label>
                            <input type="url" name="video" value="{{ old('video') }}" placeholder="https://www.youtube.com/watch?v=xxxxxx" class="w-full font-medium border @error('video') border-red-500 @else border-slate-200 @enderror rounded-xl p-3 bg-slate-50 focus:outline-none focus:border-indigo-500 transition text-slate-900">
                            @error('video') <span class="text-red-500 text-[10px] block mt-1"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</span> @enderror
                            <span class="text-[10px] text-slate-400 font-normal block pt-1">Masukkan alamat URL video resmi dari kanal YouTube pondok.</span>
                        </div>

                        <div class="pt-4 border-t border-slate-100 flex justify-end gap-2.5">
                            <button type="button" onclick="closeUploadModal()" class="bg-white hover:bg-slate-100 text-slate-700 px-4 py-2.5 rounded-xl border border-slate-200 transition">Batal</button>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl transition shadow-sm uppercase tracking-wider"><i class="fa-solid fa-floppy-disk mr-1"></i> Simpan Aset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <footer class="bg-white border-t border-slate-200/60 px-6 py-4 text-center text-[11px] text-slate-400 font-bold">
            <p>&copy; 2026 Core Engine Infrastructure SaaS Pesantren. Pemeliharaan File oleh <a href="#" class="text-indigo-600 hover:underline">lagingoding.com</a></p>
        </footer>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function openUploadModal() {
            const modal = document.getElementById('uploadMediaModal');
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
            toggleModalFormInputs(); // Sesuaikan input tersembunyi saat dibuka
        }

        function closeUploadModal() {
            const modal = document.getElementById('uploadMediaModal');
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        function toggleModalFormInputs() {
            const selector = document.getElementById('mediaTypeSelector').value;
            const slotImage = document.getElementById('slotImageUpload');
            const slotVideo = document.getElementById('slotVideoLink');

            if (selector === 'image_upload') {
                slotImage.classList.remove('hidden');
                slotVideo.classList.add('hidden');
            } else {
                slotImage.classList.add('hidden');
                slotVideo.classList.remove('hidden');
            }
        }

        // AUTO OPEN MODAL SAAT VALIDASI FORM LARAVEL GAGAL
        @if($errors->any())
            openUploadModal();
        @endif

        // NOTIFIKASI SWEETALERT FLASH SESSIONS
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#4f46e5',
                customClass: { popup: 'rounded-2xl' }
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal Memproses Berkas!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#e11d48',
                customClass: { popup: 'rounded-2xl' }
            });
        @endif

        // SWEETALERT KONFIRMASI HAPUS DATA MEDIA
        function confirmDelete(id) {
            Swal.fire({
                title: 'Hapus Media Ini?',
                text: "Aset dokumentasi akan dihapus permanen dari server publik!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e11d48',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'Ya, Hapus Media',
                cancelButtonText: 'Batal',
                customClass: { popup: 'rounded-2xl' }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
@endsection