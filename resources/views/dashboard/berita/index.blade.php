@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
<script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

<style>
    /* Menyelaraskan tampilan editor Trix dengan tema Tailwind dashboard kamu */
    trix-editor {
        background-color: #f8fafc !important; /* bg-slate-50 */
        border-radius: 0.75rem !important; /* rounded-xl */
        border-color: #e2e8f0 !important; /* border-slate-200 */
        padding: 0.75rem !important;
        font-family: ui-sans-serif, system-ui, sans-serif;
        font-weight: 400;
        color: #1e293b !important; /* text-slate-800 */
        min-height: 250px !important;
    }
    trix-editor:focus {
        background-color: #ffffff !important;
        border-color: #4f46e5 !important; /* focus:border-indigo-500 */
        outline: none;
    }
    
    /* Sembunyikan fitur upload berkas bawaan Trix */
    trix-toolbar .trix-button-group--file-tools {
        display: none !important;
    }

    /* ======================================================= */
    /* PERBAIKAN RESET TAILWIND UNTUK TRIX EDITOR (RICH TEXT)  */
    /* ======================================================= */
    
    /* Mengembalikan format Bold (Tebal) dan Italic (Miring) */
    trix-editor strong, trix-editor b {
        font-weight: bold !important;
    }
    trix-editor em, trix-editor i {
        font-style: italic !important;
    }

    /* Mengembalikan format Bullet List (Daftar Bulat) */
    trix-editor ul {
        list-style-type: disc !important;
        margin-left: 1.5rem !important;
        padding-left: 0.5rem !important;
    }
    trix-editor ul li {
        list-style-type: disc !important;
    }

    /* Mengembalikan format Numbered List (Daftar Angka) */
    trix-editor ol {
        list-style-type: decimal !important;
        margin-left: 1.5rem !important;
        padding-left: 0.5rem !important;
    }
    trix-editor ol li {
        list-style-type: decimal !important;
    }

    /* Mengembalikan format Heading/Subelemen */
    trix-editor h1 {
        font-size: 1.5em !important;
        font-weight: bold !important;
        line-height: 1.2 !important;
    }
</style>
<main class="grow flex flex-col min-w-0">
    
    <!-- Header Top Bar -->
    <header class="bg-white border-b border-slate-200/60 px-6 py-4 flex justify-between items-center sticky top-0 z-30 shadow-sm shadow-slate-100/50">
        <div class="flex items-center gap-3">
            <button class="md:hidden text-slate-600"><i class="fa-solid fa-bars text-lg"></i></button>
            <h3 class="text-slate-900 font-black text-sm md:text-base tracking-tight">Manajemen Konten Berita & Informasi</h3>
        </div>
        <div class="text-xs font-bold flex items-center gap-2">
            <button onclick="openNewsModal()" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2.5 rounded-xl transition flex items-center gap-1.5 shadow-sm shadow-indigo-600/10">
                <i class="fa-solid fa-plus text-[10px]"></i> Tambah Artikel Baru
            </button>
        </div>
    </header>

    <!-- Container Isi Dokumen -->
    <div class="p-6 space-y-6 overflow-y-auto grow">
        
        <!-- PANEL SELEKSI & PENCARIAN DATA (Filter Bar) -->
        <section class="bg-white border border-slate-200/80 rounded-2xl p-4 shadow-sm flex flex-col lg:flex-row justify-between items-center gap-4">
            <form action="{{ route('dashboard.berita.index') }}" method="GET" id="searchFilterForm" class="flex flex-col sm:flex-row items-center gap-3 w-full lg:w-auto text-xs font-bold">
                <div class="relative w-full sm:w-64">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Cari judul berita..." class="w-full border border-slate-200 rounded-xl pl-9 pr-4 py-2.5 bg-slate-50 focus:outline-none focus:border-indigo-500 focus:bg-white shadow-inner transition font-medium">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-3.5 text-slate-400"></i>
                </div>
                <select name="kategori" onchange="document.getElementById('searchFilterForm').submit()" class="border border-slate-200 bg-slate-50 px-3 py-2.5 rounded-xl text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition cursor-pointer w-full sm:w-auto">
                    <option value="">Semua Kategori</option>
                    <option value="Kegiatan Santri" {{ $filter_kategori == 'Kegiatan Santri' ? 'selected' : '' }}>Kegiatan Santri</option>
                    <option value="Kabar Prestasi" {{ $filter_kategori == 'Kabar Prestasi' ? 'selected' : '' }}>Kabar Prestasi</option>
                    <option value="Maklumat Resmi" {{ $filter_kategori == 'Maklumat Resmi' ? 'selected' : '' }}>Maklumat Resmi</option>
                </select>
                @if($search || $filter_kategori)
                    <a href="{{ route('dashboard.berita.index') }}" class="text-indigo-600 hover:text-indigo-800 text-xs">Reset Filter</a>
                @endif
            </form>
            <div class="text-[11px] text-slate-400 font-bold self-end lg:self-center">
                Total Konten: <span class="text-slate-900">{{ $totalKonten }} Artikel</span>
            </div>
        </section>

        <!-- TABEL UTAMA DATABASE BERITA -->
        <section class="bg-white border border-slate-200/80 rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200 text-slate-400 font-black bg-slate-50/70 uppercase tracking-wider text-[10px]">
                            <th class="p-4 w-24">Media</th>
                            <th class="p-4">Judul Artikel & Informasi</th>
                            <th class="p-4">Kategori</th>
                            <th class="p-4">Tanggal Rilis</th>
                            <th class="p-4">Penulis</th>
                            <th class="p-4 text-center">Aksi Operasional</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                        @forelse ($daftar_berita as $item)
                        <tr class="hover:bg-slate-50/40 transition">
                            <td class="p-4">
                                <div class="w-16 h-11 bg-slate-100 rounded-lg flex items-center justify-center border border-slate-200 overflow-hidden">
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="Sampul" class="w-full h-full object-cover">
                                </div>
                            </td>
                            <td class="p-4 max-w-sm">
                                <h5 class="font-bold text-slate-900 text-sm truncate" title="{{ $item->judul }}">{{ $item->judul }}</h5>
                                <p class="text-[11px] text-slate-400 font-normal mt-0.5 line-clamp-1">{{ strip_tags($item->isi) }}</p>
                            </td>
                            <td class="p-4">
                                <span class="bg-indigo-50 text-indigo-700 px-2.5 py-1 rounded-lg text-[10px] font-black tracking-wide border border-indigo-100 whitespace-nowrap">
                                    {{ $item->kategori }}
                                </span>
                            </td>
                            <td class="p-4 text-slate-400 whitespace-nowrap">{{ $item->created_at->translatedFormat('d M Y') }}</td>
                            <td class="p-4 text-slate-900 font-bold whitespace-nowrap">{{ $item->penulis }}</td>
                            <td class="p-4 text-center space-x-1 whitespace-nowrap flex justify-center">
                                <button type="button" onclick="openNewsModal({{ json_encode($item) }})" class="bg-slate-100 hover:bg-slate-200 text-slate-700 w-7 h-7 rounded-lg transition text-xs border border-slate-200" title="Ubah Konten"><i class="fa-solid fa-pen"></i></button>
                                
                                <form action="{{ route('dashboard.berita.destroy', $item->id) }}" method="POST" id="delete-form-{{ $item->id }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete('{{ $item->id }}')" class="bg-rose-50 hover:bg-rose-100 text-rose-600 w-7 h-7 rounded-lg transition text-xs border border-rose-200/60" title="Hapus Berita"><i class="fa-solid fa-trash-can"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-slate-400 italic font-medium">Tidak ada artikel berita yang ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- KOMPONEN PAGINATION LINK LINK DARI LARAVEL -->
            @if ($daftar_berita->hasPages())
            <div class="bg-slate-50/50 border-t border-slate-100 px-4 py-3 text-slate-500">
                {{ $daftar_berita->links() }}
            </div>
            @endif
        </section>
    </div>

    <!-- ========================================== -->
    <!-- MODAL AKSI TERPADU (TAMBAH / EDIT BERITA)   -->
    <!-- ========================================== -->
    <div id="newsActionModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-slate-950 bg-opacity-50 backdrop-blur-sm" onclick="closeNewsModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

            <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-2xl shadow-2xl sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full border border-slate-200 relative z-50">
                <div class="bg-white px-6 pt-6 pb-4 border-b border-slate-100 flex justify-between items-center">
                    <h4 id="modalTitle" class="text-sm font-black text-slate-900 tracking-tight">Tulis Lembar Artikel Baru</h4>
                    <button onclick="closeNewsModal()" class="text-slate-400 hover:text-slate-600 transition"><i class="fa-solid fa-xmark text-sm"></i></button>
                </div>

                <form id="newsForm" action="{{ route('dashboard.berita.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4 text-xs font-bold">
                    @csrf
                    <input type="hidden" id="methodField" name="_method" value="POST">
                    <input type="hidden" id="berita_id" name="berita_id" value="{{ old('berita_id') }}">

                    <div>
                        <label class="block text-slate-700 mb-1.5">Judul Informasi / Judul Utama Berita *</label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required placeholder="Tuliskan judul berita yang memikat..." class="w-full font-medium border @error('judul') border-red-500 @else border-slate-200 @enderror rounded-xl p-3 bg-slate-50 focus:outline-none focus:border-indigo-500 transition text-slate-900">
                        @error('judul') <span class="text-red-500 text-[10px] block mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-slate-700 mb-1.5">Kategori Kanal Informasi *</label>
                            <select name="kategori" id="kategori" required class="w-full border @error('kategori') border-red-500 @else border-slate-200 @enderror bg-slate-50 p-3 rounded-xl text-slate-700 focus:outline-none focus:border-indigo-500 transition cursor-pointer">
                                <option value="Kegiatan Santri" {{ old('kategori') == 'Kegiatan Santri' ? 'selected' : '' }}>Kegiatan Santri</option>
                                <option value="Kabar Prestasi" {{ old('kategori') == 'Kabar Prestasi' ? 'selected' : '' }}>Kabar Prestasi</option>
                                <option value="Maklumat Resmi" {{ old('kategori') == 'Maklumat Resmi' ? 'selected' : '' }}>Maklumat Resmi</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-slate-700 mb-1.5">Gambar Utama Sampul <span id="imageRequiredText">*</span></label>
                            <input type="file" name="gambar" id="gambar" class="w-full text-slate-500 font-medium file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border @error('gambar') border-red-500 @else border-slate-200 @enderror file:text-[10px] file:font-bold file:bg-slate-900 file:text-cyan-400 cursor-pointer">
                            @error('gambar') <span class="text-red-500 text-[10px] block mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-slate-700 mb-1.5">Isi Redaksi Berita Lengkap *</label>
                        <div>
                            <label class="block text-slate-700 mb-1.5">Isi Redaksi Berita Lengkap *</label>
                            
                            <input type="hidden" name="isi" id="isi" value="{{ old('isi') }}" required>
                            
                            <div class="@error('isi') border border-red-500 rounded-xl p-1 @enderror">
                                <trix-editor input="isi" placeholder="Tuliskan isi berita secara naratif, rapi, dan lengkap di sini..."></trix-editor>
                            </div>
                            
                            @error('isi') <span class="text-red-500 text-[10px] block mt-1">{{ $message }}</span> @enderror
                        </div>
                        @error('isi') <span class="text-red-500 text-[10px] block mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex justify-end gap-2.5">
                        <button type="button" onclick="closeNewsModal()" class="bg-white hover:bg-slate-100 text-slate-700 px-4 py-2.5 rounded-xl border border-slate-200 transition">Batal</button>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl transition shadow-sm uppercase tracking-wider">Terbitkan Berita</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200/60 px-6 py-4 text-center text-[11px] text-slate-400 font-bold">
        <p>&copy; 2026 Core Engine Infrastructure SaaS Pesantren. Pemeliharaan Konten oleh <a href="#" class="text-indigo-600 hover:underline">lagingoding.com</a></p>
    </footer>

</main>

<!-- Injeksi SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function openNewsModal(data = null) {
        const modal = document.getElementById('newsActionModal');
        const form = document.getElementById('newsForm');
        const title = document.getElementById('modalTitle');
        const methodField = document.getElementById('methodField');
        const imgInput = document.getElementById('gambar');
        const reqText = document.getElementById('imageRequiredText');

        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');

        if (data) {
            title.innerText = 'Ubah Redaksi Artikel Berita';
            form.action = `/dashboard/berita/${data.id}`;
            methodField.value = 'PUT';
            
            document.getElementById('berita_id').value = data.id;
            document.getElementById('judul').value = data.judul;
            document.getElementById('kategori').value = data.kategori;
            document.getElementById('isi').value = data.isi;
            
            imgInput.required = false;
            if(reqText) reqText.innerText = '(Opsional)';
        } else {
            title.innerText = 'Tulis Lembar Artikel Baru';
            form.action = "{{ route('dashboard.berita.store') }}";
            methodField.value = 'POST';
            
            document.getElementById('berita_id').value = '';
            document.getElementById('judul').value = '';
            document.getElementById('isi').value = '';
            
            imgInput.required = true;
            if(reqText) reqText.innerText = '*';
        }
    }

    function closeNewsModal() {
        const modal = document.getElementById('newsActionModal');
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    // AUTOMATIC MODAL RESTORE JIKA VALIDASI FORM GAGAL
    @if($errors->any())
        @if(old('_method') == 'PUT')
            openNewsModal({
                id: '{!! old("berita_id") !!}',
                judul: '{!! addslashes(old("judul")) !!}',
                kategori: '{!! old("kategori") !!}',
                isi: '{!! addslashes(old("isi")) !!}'
            });
        @else
            openNewsModal();
        @endif
    @endif

    // SWEETALERT POP-UP NOTIFICATIONS
    @if(session('success'))
        Swal.fire({ icon: 'success', title: 'Berhasil!', text: '{{ session("success") }}', confirmButtonColor: '#4f46e5', customClass: { popup: 'rounded-2xl' } });
    @endif

    @if(session('error'))
        Swal.fire({ icon: 'error', title: 'Operasi Gagal!', text: '{{ session("error") }}', confirmButtonColor: '#e11d48', customClass: { popup: 'rounded-2xl' } });
    @endif

    // SWEETALERT CONFIRMATION UNTUK DELETION
    function confirmDelete(id) {
        Swal.fire({
            title: 'Hapus Berita?',
            text: "Artikel beserta file gambar sampul akan dihapus selamanya!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e11d48',
            cancelButtonColor: '#94a3b8',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            customClass: { popup: 'rounded-2xl' }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }

    function openNewsModal(data = null) {
    const modal = document.getElementById('newsActionModal');
    const form = document.getElementById('newsForm');
    const title = document.getElementById('modalTitle');
    const methodField = document.getElementById('methodField');
    const imgInput = document.getElementById('gambar');
    const reqText = document.getElementById('imageRequiredText');
    
    // Ambil elemen trix-editor
    const trixEditor = document.querySelector("trix-editor");

    modal.classList.remove('hidden');
    document.body.classList.add('overflow-hidden');

    if (data) {
        title.innerText = 'Ubah Redaksi Artikel Berita';
        form.action = `/dashboard/berita/${data.id}`;
        methodField.value = 'PUT';
        
        document.getElementById('berita_id').value = data.id;
        document.getElementById('judul').value = data.judul;
        document.getElementById('kategori').value = data.kategori;
        
        // Mengisi value ke input hidden DAN memperbarui tampilan komponen Trix Editor
        document.getElementById('isi').value = data.isi;
        trixEditor.editor.loadHTML(data.isi);
        
        imgInput.required = false;
        if(reqText) reqText.innerText = '(Opsional)';
    } else {
        title.innerText = 'Tulis Lembar Artikel Baru';
        form.action = "{{ route('dashboard.berita.store') }}";
        methodField.value = 'POST';
        
        document.getElementById('berita_id').value = '';
        document.getElementById('judul').value = '';
        
        // Mengosongkan input hidden DAN mengosongkan komponen Trix Editor
        document.getElementById('isi').value = '';
        trixEditor.editor.loadHTML('');
        
        imgInput.required = true;
        if(reqText) reqText.innerText = '*';
    }
}
</script>
@endsection