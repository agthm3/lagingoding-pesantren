@extends('layouts.dashboard')

@section('content')
<main class="grow flex flex-col min-w-0">
        
    <header class="bg-white border-b border-slate-200/60 px-6 py-4 flex justify-between items-center sticky top-0 z-30 shadow-sm shadow-slate-100/50">
        <div class="flex items-center gap-3">
            <button class="md:hidden text-slate-600"><i class="fa-solid fa-bars text-lg"></i></button>
            <h3 class="text-slate-900 font-black text-sm md:text-base tracking-tight">Manajemen Data Sarana & Fasilitas</h3>
        </div>
        <div class="text-xs font-bold flex items-center gap-2">
            <button onclick="openFacilityModal()" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2.5 rounded-xl transition flex items-center gap-1.5 shadow-sm shadow-indigo-600/10">
                <i class="fa-solid fa-plus text-[10px]"></i> Tambah Fasilitas Baru
            </button>
        </div>
    </header>

    <div class="p-6 space-y-6 overflow-y-auto grow">
        
        {{-- Notifikasi Sukses --}}
        @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 p-4 rounded-xl text-xs font-bold flex items-center gap-2">
            <i class="fa-solid fa-circle-check text-base"></i>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        <section class="bg-white border border-slate-200/80 rounded-2xl p-4 shadow-sm flex flex-col sm:flex-row justify-between items-center gap-4">
            <div class="flex flex-wrap items-center gap-3 w-full sm:w-auto text-xs font-bold">
                <form action="{{ route('dashboard.sarana.index') }}" method="GET" class="relative w-full sm:w-64">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama atau kategori..." class="w-full border border-slate-200 rounded-xl pl-9 pr-4 py-2.5 bg-slate-50 focus:outline-none focus:border-indigo-500 focus:bg-white shadow-inner transition font-medium text-slate-800">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-3.5 text-slate-400"></i>
                </form>
            </div>
            <div class="text-[11px] text-slate-400 font-bold self-end sm:self-center">
                Total Aset Kampus: <span class="text-slate-900">{{ $totalAset }} Unit Terdata</span>
            </div>
        </section>

        <section class="bg-white border border-slate-200/80 rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200 text-slate-400 font-black bg-slate-50/70 uppercase tracking-wider text-[10px]">
                            <th class="p-4 w-24">Media Foto</th>
                            <th class="p-4">Nama Sarana Fasilitas</th>
                            <th class="p-4">Kategori Kluster</th>
                            <th class="p-4">Deskripsi / Spesifikasi Ringkas</th>
                            <th class="p-4 text-center">Aksi Operasional</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                        
                        @forelse ($saranas as $sarana)
                        <tr class="hover:bg-slate-50/40 transition">
                            <td class="p-4">
                                <div class="w-16 h-11 bg-slate-100 rounded-lg flex items-center justify-center text-slate-300 border border-slate-200 overflow-hidden">
                                    <img src="{{ asset('storage/' . $sarana->foto) }}" alt="{{ $sarana->nama_sarana }}" class="w-full h-full object-cover">
                                </div>
                            </td>
                            <td class="p-4 font-bold text-slate-900 text-sm">{{ $sarana->nama_sarana }}</td>
                            <td class="p-4"><span class="bg-indigo-50 text-indigo-700 px-2.5 py-1 rounded-lg text-[10px] font-black tracking-wide border border-indigo-100">{{ $sarana->kategori }}</span></td>
                            <td class="p-4 text-slate-400 max-w-xs truncate" title="{{ $sarana->deskripsi }}">{{ $sarana->deskripsi }}</td>
                            <td class="p-4 text-center space-x-1 whitespace-nowrap">
                                <button onclick="openFacilityModal({{ json_encode($sarana) }})" class="bg-slate-100 hover:bg-slate-200 text-slate-700 w-7 h-7 rounded-lg transition text-xs border border-slate-200" title="Ubah Data"><i class="fa-solid fa-pen"></i></button>
                                
                                <form action="{{ route('dashboard.sarana.destroy', $sarana->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus sarana ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-rose-50 hover:bg-rose-100 text-rose-600 w-7 h-7 rounded-lg transition text-xs border border-rose-200/60" title="Hapus Fasilitas"><i class="fa-solid fa-trash-can"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-slate-400 font-medium">Belum ada data sarana prasarana terdaftar.</td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </section>
    </div>

    {{-- Modal Tambah / Edit Terpadu --}}
    <div id="facilityActionModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-slate-950 bg-opacity-50 backdrop-blur-sm" onclick="closeFacilityModal()"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-2xl shadow-2xl sm:my-8 sm:align-middle sm:max-w-md sm:w-full border border-slate-200">
                <div class="bg-white px-6 pt-6 pb-4 border-b border-slate-100 flex justify-between items-center">
                    <h4 id="modalTitle" class="text-sm font-black text-slate-900 tracking-tight">Tambah Infrastruktur Sarana Baru</h4>
                    <button onclick="closeFacilityModal()" class="text-slate-400 hover:text-slate-600 transition focus:outline-none"><i class="fa-solid fa-xmark text-sm"></i></button>
                </div>

                <form id="facilityForm" action="{{ route('dashboard.sarana.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4 text-xs font-bold">
                    @csrf
                    <input type="hidden" id="methodField" name="_method" value="POST">

                    <div>
                        <label class="block text-slate-700 mb-1.5">Nama Fasilitas / Sarana Gedung *</label>
                        <input type="text" id="nama_sarana" name="nama_sarana" required placeholder="Contoh: Gedung Laboratorium Bahasa Terpadu" class="w-full font-medium border border-slate-200 rounded-xl p-3 bg-slate-50 focus:outline-none focus:border-indigo-500 focus:bg-white shadow-inner transition text-slate-900">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-slate-700 mb-1.5">Kluster / Kategori Tampilan *</label>
                            <input type="text" id="kategori" name="kategori" required placeholder="Contoh: Akademik / Teknologi / Hunian" class="w-full font-bold border border-slate-200 rounded-xl p-3 bg-slate-50 focus:outline-none focus:border-indigo-500 focus:bg-white shadow-inner transition text-slate-800">
                            <span class="text-[9px] text-slate-400 font-normal block mt-1">Gunakan kata tunggal pembeda kategori.</span>
                        </div>

                        <div>
                            <label class="block text-slate-700 mb-1.5">Foto Dokumentasi Prasarana <span id="fotoRequiredLabel">*</span></label>
                            <input type="file" id="foto" name="foto" required class="w-full text-slate-500 font-medium file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border file:border-slate-200 file:text-[10px] file:font-bold file:bg-slate-900 file:text-cyan-400 hover:file:bg-slate-800 cursor-pointer transition">
                        </div>
                    </div>

                    <div>
                        <label class="block text-slate-700 mb-1.5">Deskripsi Detail & Spesifikasi Alat *</label>
                        <textarea id="deskripsi" name="deskripsi" required rows="4" placeholder="Tuliskan keterangan daya tampung gedung, fungsi ruangan, atau spesifikasi infrastruktur sarana secara lengkap di sini..." class="w-full font-normal border border-slate-200 rounded-xl p-3 bg-slate-50 focus:outline-none focus:border-indigo-500 focus:bg-white shadow-inner transition text-slate-800 leading-relaxed resize-none"></textarea>
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex justify-end gap-2.5">
                        <button type="button" onclick="closeFacilityModal()" class="bg-white hover:bg-slate-100 text-slate-700 px-4 py-2.5 rounded-xl border border-slate-200 transition">Batal</button>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl transition shadow-sm uppercase tracking-wider"><i class="fa-solid fa-floppy-disk mr-1"></i> Simpan Sarana</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer class="bg-white border-t border-slate-200/60 px-6 py-4 text-center text-[11px] text-slate-400 font-bold">
        <p>&copy; 2026 Core Engine Infrastructure SaaS Pesantren. Pemeliharaan Modul oleh <a href="#" class="text-indigo-600 hover:underline">lagingoding.com</a></p>
    </footer>

</main>

{{-- Tambahkan CDN SweetAlert2 jika belum ada di layout utama --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function openFacilityModal(data = null) {
            const modal = document.getElementById('facilityActionModal');
            const form = document.getElementById('facilityForm');
            const title = document.getElementById('modalTitle');
            const methodField = document.getElementById('methodField');
            const fotoInput = document.getElementById('foto');
            const fotoRequiredLabel = document.getElementById('fotoRequiredLabel');

            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');

            if (data) {
                title.innerText = 'Ubah Data Infrastruktur Sarana';
                form.action = `/dashboard/sarana/${data.id}`;
                methodField.value = 'PUT';
                
                document.getElementById('nama_sarana').value = data.nama_sarana;
                document.getElementById('kategori').value = data.kategori;
                document.getElementById('deskripsi').value = data.deskripsi;
                
                fotoInput.required = false;
                if(fotoRequiredLabel) fotoRequiredLabel.classList.add('hidden');
            } else {
                title.innerText = 'Tambah Infrastruktur Sarana Baru';
                form.action = "{{ route('dashboard.sarana.store') }}";
                methodField.value = 'POST';
                
                form.reset();
                
                fotoInput.required = true;
                if(fotoRequiredLabel) fotoRequiredLabel.classList.remove('hidden');
            }
        }

        function closeFacilityModal() {
            const modal = document.getElementById('facilityActionModal');
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // ==========================================
        // SISTEM DETEKSI & HANDLING ERROR VALIDASI
        // ==========================================
        
        // 1. Flash Session Sukses Umum
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#4f46e5',
                customClass: { popup: 'rounded-2xl' }
            });
        @endif

        // 2. Flash Session Gagal System/Try-Catch
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal Memproses!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#e11d48',
                customClass: { popup: 'rounded-2xl' }
            });
        @endif

        // 3. Ambil Semua Error Validasi Input (Termasuk File Overweight)
        @if($errors->any())
            let errorMessages = '';
            @foreach ($errors->all() as $error)
                errorMessages += '• {{ $error }}\n';
            @endforeach

            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal!',
                text: errorMessages,
                confirmButtonColor: '#e11d48',
                customClass: { popup: 'rounded-2xl' }
            }).then(() => {
                // Otomatis buka kembali modal form agar user bisa langsung memperbaiki inputnya
                @if(old('_method') == 'PUT')
                    // Jika sebelumnya gagal pas update, panggil modal mode edit kembali
                    openFacilityModal({
                        id: '{{ basename(url()->current()) }}', // Mengambil ID dari segmen URL terakhir
                        nama_sarana: '{!! addslashes(old('nama_sarana')) !!}',
                        kategori: '{!! addslashes(old('kategori')) !!}',
                        deskripsi: '{!! addslashes(old('deskripsi')) !!}'
                    });
                @else
                    // Jika gagal pas tambah data baru
                    openFacilityModal();
                @endif
            });
        @endif
    </script>
@endsection