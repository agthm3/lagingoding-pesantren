@extends('layouts.dashboard')

@section('content')
    <main class="grow flex flex-col min-w-0">
        
        <header class="bg-white border-b border-slate-200/60 px-6 py-4 flex justify-between items-center sticky top-0 z-30 shadow-sm shadow-slate-100/50">
            <div class="flex items-center gap-3">
                <button class="md:hidden text-slate-600"><i class="fa-solid fa-bars text-lg"></i></button>
                <h3 class="text-slate-900 font-black text-sm md:text-base tracking-tight">Manajemen Etalase Prestasi & Penghargaan</h3>
            </div>
            <div class="text-xs font-bold flex items-center gap-2">
                <button onclick="openTrophyModal()" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2.5 rounded-xl transition flex items-center gap-1.5 shadow-sm shadow-indigo-600/10">
                    <i class="fa-solid fa-plus text-[10px]"></i> Input Prestasi Baru
                </button>
            </div>
        </header>

        <div class="p-6 space-y-6 overflow-y-auto grow">
            
            <section class="bg-white border border-slate-200/80 rounded-2xl p-4 shadow-sm flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="flex flex-wrap items-center gap-3 w-full sm:w-auto text-xs font-bold">
                    <div class="relative w-full sm:w-64">
                        <input type="text" placeholder="Cari nama santri atau lomba..." class="w-full border border-slate-200 rounded-xl pl-9 pr-4 py-2.5 bg-slate-50 focus:outline-none focus:border-indigo-500 focus:bg-white shadow-inner transition font-medium text-slate-800">
                        <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-3.5 text-slate-400"></i>
                    </div>
                </div>
                <div class="text-[11px] text-slate-400 font-bold self-end sm:self-center">
                    Total Penghargaan: <span class="text-slate-900">{{ $daftar_prestasi->count() }} Piala Terpajang</span>
                </div>
            </section>

            <section class="bg-white border border-slate-200/80 rounded-2xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="border-b border-slate-200 text-slate-400 font-black bg-slate-50/70 uppercase tracking-wider text-[10px]">
                                <th class="p-4 w-24">Foto Dokumentasi</th>
                                <th class="p-4">Nama Santri Peraih</th>
                                <th class="p-4">Judul Kejuaraan / Penghargaan</th>
                                <th class="p-4">Tingkat</th>
                                <th class="p-4">Penyelenggara / Tahun</th>
                                <th class="p-4 text-center">Aksi Operasional</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                            
                            @forelse ($daftar_prestasi as $item)
                            <tr class="hover:bg-slate-50/40 transition">
                                <td class="p-4">
                                    <div class="w-16 h-11 bg-slate-100 rounded-lg flex items-center justify-center border border-slate-200 overflow-hidden">
                                        <img src="{{ Storage::url($item->foto) }}" alt="Foto" class="w-full h-full object-cover">
                                    </div>
                                </td>
                                <td class="p-4 font-bold text-slate-900 text-sm">{{ $item->nama_santri }}</td>
                                <td class="p-4">
                                    <h5 class="font-bold text-slate-800">{{ $item->judul_prestasi }}</h5>
                                </td>
                                <td class="p-4">
                                    <span class="bg-indigo-50 text-indigo-700 border border-indigo-100 px-2.5 py-0.5 rounded-full text-[10px] font-bold">{{ $item->tingkat }}</span>
                                </td>
                                <td class="p-4 text-slate-500">{{ $item->penyelenggara }} • <span class="text-slate-400 font-normal">{{ $item->tahun }}</span></td>
                                <td class="p-4 text-center space-x-1 whitespace-nowrap flex justify-center">
                                    <button type="button" onclick="openEditModal('{{ $item->id }}', '{{ $item->nama_santri }}', '{{ $item->judul_prestasi }}', '{{ $item->tingkat }}', '{{ $item->penyelenggara }}', '{{ $item->tahun }}')" class="bg-slate-100 hover:bg-slate-200 text-slate-700 w-7 h-7 rounded-lg transition text-xs border border-slate-200" title="Ubah Data"><i class="fa-solid fa-pen"></i></button>
                                    
                                    <form action="{{ route('dashboard.prestasi.destroy', $item->id) }}" method="POST" id="delete-form-{{ $item->id }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete({{ $item->id }})" class="bg-rose-50 hover:bg-rose-100 text-rose-600 w-7 h-7 rounded-lg transition text-xs border border-rose-200/60" title="Hapus Data"><i class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="p-8 text-center text-slate-400 italic">Belum ada data prestasi.</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </section>
        </div>
<div id="trophyActionModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-slate-950 bg-opacity-50 backdrop-blur-sm" onclick="closeTrophyModal()"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

                <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-2xl shadow-2xl sm:my-8 sm:align-middle sm:max-w-md sm:w-full border border-slate-200 relative z-50">
                    <div class="bg-white px-6 pt-6 pb-4 border-b border-slate-100 flex justify-between items-center">
                        <h4 class="text-sm font-black text-slate-900 tracking-tight">Tambah Penghargaan Santri Baru</h4>
                        <button onclick="closeTrophyModal()" class="text-slate-400 hover:text-slate-600 transition focus:outline-none"><i class="fa-solid fa-xmark text-sm"></i></button>
                    </div>

                    <form action="{{ route('dashboard.prestasi.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4 text-xs font-bold">
                        @csrf
                        
                        <div>
                            <label class="block text-slate-700 mb-1.5">Nama Santri Peraih Penghargaan *</label>
                            <input type="text" name="nama_santri" value="{{ old('nama_santri') }}" required class="w-full font-medium border @error('nama_santri') border-red-500 @else border-slate-200 @enderror rounded-xl p-3 bg-slate-50 focus:outline-none focus:border-indigo-500 transition text-slate-900">
                            @error('nama_santri') <span class="text-red-500 text-[10px] block mt-1"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label class="block text-slate-700 mb-1.5">Judul Prestasi / Piala Juara *</label>
                            <input type="text" name="judul_prestasi" value="{{ old('judul_prestasi') }}" required class="w-full font-medium border @error('judul_prestasi') border-red-500 @else border-slate-200 @enderror rounded-xl p-3 bg-slate-50 focus:outline-none focus:border-indigo-500 transition text-slate-900">
                            @error('judul_prestasi') <span class="text-red-500 text-[10px] block mt-1"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-slate-700 mb-1.5">Skala Tingkatan Kejuaraan *</label>
                                <select name="tingkat" required class="w-full border @error('tingkat') border-red-500 @else border-slate-200 @enderror bg-slate-50 p-3 rounded-xl text-slate-700 focus:outline-none focus:border-indigo-500 transition">
                                    <option value="Kabupaten" {{ old('tingkat') == 'Kabupaten' ? 'selected' : '' }}>Kabupaten / Kota</option>
                                    <option value="Provinsi" {{ old('tingkat') == 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
                                    <option value="Nasional" {{ old('tingkat') == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                                    <option value="Internasional" {{ old('tingkat') == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                                </select>
                                @error('tingkat') <span class="text-red-500 text-[10px] block mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-slate-700 mb-1.5">Foto Piala / Sertifikat *</label>
                                <input type="file" name="foto" required class="w-full text-slate-500 font-medium file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border @error('foto') border-red-500 @else border-slate-200 @enderror file:text-[10px] file:font-bold file:bg-slate-900 file:text-cyan-400 cursor-pointer">
                                @error('foto') <span class="text-red-500 text-[10px] block mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-slate-700 mb-1.5">Lembaga Penyelenggara *</label>
                                <input type="text" name="penyelenggara" value="{{ old('penyelenggara') }}" required class="w-full font-medium border @error('penyelenggara') border-red-500 @else border-slate-200 @enderror rounded-xl p-3 bg-slate-50 focus:outline-none focus:border-indigo-500 transition text-slate-900">
                                @error('penyelenggara') <span class="text-red-500 text-[10px] block mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-slate-700 mb-1.5">Tahun Perolehan *</label>
                                <input type="number" name="tahun" value="{{ old('tahun', date('Y')) }}" required class="w-full font-bold border @error('tahun') border-red-500 @else border-slate-200 @enderror rounded-xl p-3 bg-slate-50 focus:outline-none focus:border-indigo-500 transition text-slate-900">
                                @error('tahun') <span class="text-red-500 text-[10px] block mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        
                        <div class="pt-4 border-t border-slate-100 flex justify-end gap-2.5">
                            <button type="button" onclick="closeTrophyModal()" class="bg-white hover:bg-slate-100 text-slate-700 px-4 py-2.5 rounded-xl border border-slate-200 transition">Batal</button>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl transition shadow-sm uppercase tracking-wider">Simpan Prestasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="editActionModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-slate-950 bg-opacity-50 backdrop-blur-sm" onclick="closeEditModal()"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

                <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-2xl shadow-2xl sm:my-8 sm:align-middle sm:max-w-md sm:w-full border border-slate-200 relative z-50">
                    <div class="bg-white px-6 pt-6 pb-4 border-b border-slate-100 flex justify-between items-center">
                        <h4 class="text-sm font-black text-slate-900 tracking-tight">Ubah Data Prestasi</h4>
                        <button onclick="closeEditModal()" class="text-slate-400 hover:text-slate-600 transition focus:outline-none"><i class="fa-solid fa-xmark text-sm"></i></button>
                    </div>

                    <form id="editForm" method="POST" enctype="multipart/form-data" class="p-6 space-y-4 text-xs font-bold">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="prestasi_id" id="edit_id" value="{{ old('prestasi_id') }}">
                        
                        <div>
                            <label class="block text-slate-700 mb-1.5">Nama Santri Peraih Penghargaan *</label>
                            <input type="text" name="nama_santri" id="edit_nama" required class="w-full font-medium border @error('nama_santri') border-red-500 @else border-slate-200 @enderror rounded-xl p-3 bg-slate-50 focus:outline-none focus:border-indigo-500 transition text-slate-900">
                            @error('nama_santri') <span class="text-red-500 text-[10px] block mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-slate-700 mb-1.5">Judul Prestasi / Piala Juara *</label>
                            <input type="text" name="judul_prestasi" id="edit_judul" required class="w-full font-medium border @error('judul_prestasi') border-red-500 @else border-slate-200 @enderror rounded-xl p-3 bg-slate-50 focus:outline-none focus:border-indigo-500 transition text-slate-900">
                            @error('judul_prestasi') <span class="text-red-500 text-[10px] block mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-slate-700 mb-1.5">Skala Tingkatan *</label>
                                <select name="tingkat" id="edit_tingkat" required class="w-full border @error('tingkat') border-red-500 @else border-slate-200 @enderror bg-slate-50 p-3 rounded-xl text-slate-700 focus:outline-none focus:border-indigo-500 transition">
                                    <option value="Kabupaten">Kabupaten / Kota</option>
                                    <option value="Provinsi">Provinsi</option>
                                    <option value="Nasional">Nasional</option>
                                    <option value="Internasional">Internasional</option>
                                </select>
                                @error('tingkat') <span class="text-red-500 text-[10px] block mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-slate-700 mb-1.5">Ganti Foto (Opsional)</label>
                                <input type="file" name="foto" class="w-full text-slate-500 font-medium file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border @error('foto') border-red-500 @else border-slate-200 @enderror file:text-[10px] file:font-bold file:bg-slate-900 file:text-cyan-400 cursor-pointer">
                                @error('foto') <span class="text-red-500 text-[10px] block mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-slate-700 mb-1.5">Lembaga Penyelenggara *</label>
                                <input type="text" name="penyelenggara" id="edit_penyelenggara" required class="w-full font-medium border @error('penyelenggara') border-red-500 @else border-slate-200 @enderror rounded-xl p-3 bg-slate-50 focus:outline-none focus:border-indigo-500 transition text-slate-900">
                                @error('penyelenggara') <span class="text-red-500 text-[10px] block mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-slate-700 mb-1.5">Tahun *</label>
                                <input type="number" name="tahun" id="edit_tahun" required class="w-full font-bold border @error('tahun') border-red-500 @else border-slate-200 @enderror rounded-xl p-3 bg-slate-50 focus:outline-none focus:border-indigo-500 transition text-slate-900">
                                @error('tahun') <span class="text-red-500 text-[10px] block mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="pt-4 border-t border-slate-100 flex justify-end gap-2.5">
                            <button type="button" onclick="closeEditModal()" class="bg-white hover:bg-slate-100 text-slate-700 px-4 py-2.5 rounded-xl border border-slate-200 transition">Batal</button>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl transition shadow-sm uppercase tracking-wider">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function openTrophyModal() {
            document.getElementById('trophyActionModal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeTrophyModal() {
            document.getElementById('trophyActionModal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // JS ini dipanggil dari onclick tombol Edit di Tabel
        function openEditModal(id, nama, judul, tingkat, penyelenggara, tahun) {
            const form = document.getElementById('editForm');
            form.action = `/dashboard/prestasi/${id}`;
            
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_judul').value = judul;
            document.getElementById('edit_tingkat').value = tingkat;
            document.getElementById('edit_penyelenggara').value = penyelenggara;
            document.getElementById('edit_tahun').value = tahun;

            document.getElementById('editActionModal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeEditModal() {
            document.getElementById('editActionModal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // LOGIKA PENANGKAP ERROR (DIPERBAIKI)
        @if($errors->any())
            @if(old('_method') == 'PUT')
                // Menggunakan addslashes() agar tanda kutip seperti (Qur'an) tidak merusak script JavaScript
                openEditModal(
                    '{!! addslashes(old("prestasi_id")) !!}', 
                    '{!! addslashes(old("nama_santri")) !!}', 
                    '{!! addslashes(old("judul_prestasi")) !!}', 
                    '{!! addslashes(old("tingkat")) !!}', 
                    '{!! addslashes(old("penyelenggara")) !!}', 
                    '{!! addslashes(old("tahun")) !!}'
                );
            @else
                openTrophyModal();
            @endif
        @endif

        // NOTIFIKASI SWEETALERT
        @if(session('success'))
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: '{{ session("success") }}', confirmButtonColor: '#4f46e5', customClass: { popup: 'rounded-2xl' } });
        @endif

        @if(session('error'))
            Swal.fire({ icon: 'error', title: 'Terjadi Kesalahan!', text: '{{ session("error") }}', confirmButtonColor: '#e11d48', customClass: { popup: 'rounded-2xl' } });
        @endif

        function confirmDelete(id) {
            Swal.fire({
                title: 'Hapus Data?',
                text: "Foto piala dan riwayat prestasi akan terhapus permanen!",
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
    </script>
@endsection