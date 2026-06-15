@extends('layouts.dashboard')

@section('content')

    <main class="grow flex flex-col min-w-0">
        
        <header class="bg-white border-b border-slate-200/60 px-6 py-4 flex justify-between items-center sticky top-0 z-30 shadow-sm shadow-slate-100/50">
            <div class="flex items-center gap-3">
                <button class="md:hidden text-slate-600"><i class="fa-solid fa-bars text-lg"></i></button>
                <h3 class="text-slate-900 font-black text-sm md:text-base tracking-tight">Kontrol Pengguna & Otoritas Hak Akses</h3>
            </div>
            <div class="text-xs font-bold flex items-center gap-2">
                <button onclick="openUserModal()" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2.5 rounded-xl transition flex items-center gap-1.5 shadow-sm shadow-indigo-600/10">
                    <i class="fa-solid fa-user-plus text-[10px]"></i> Daftarkan Pengurus Baru
                </button>
            </div>
        </header>

        <div class="p-6 space-y-6 overflow-y-auto grow">
            
            <section class="bg-white border border-slate-200/80 rounded-2xl p-4 shadow-sm flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="flex flex-wrap items-center gap-3 w-full sm:w-auto text-xs font-bold">
                    <div class="relative w-full sm:w-64">
                        <input type="text" placeholder="Cari nama atau email staf..." class="w-full border border-slate-200 rounded-xl pl-9 pr-4 py-2.5 bg-slate-50 focus:outline-none focus:border-indigo-500 focus:bg-white shadow-inner transition font-medium text-slate-800">
                        <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-3.5 text-slate-400"></i>
                    </div>
                </div>
                <div class="text-[11px] text-slate-400 font-bold self-end sm:self-center">
                    Total Pengurus Sistem: <span class="text-slate-900">{{ $users->count() }} Akun Terdaftar</span>
                </div>
            </section>

            <section class="bg-white border border-slate-200/80 rounded-2xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="border-b border-slate-200 text-slate-400 font-black bg-slate-50/70 uppercase tracking-wider text-[10px]">
                                <th class="p-4">Nama Pengguna</th>
                                <th class="p-4">Alamat Email</th>
                                <th class="p-4">Peran (Role)</th>
                                <th class="p-4">Status Akun</th>
                                <th class="p-4 text-center">Aksi Operasional</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                            @forelse ($users as $user)
                            <tr class="hover:bg-slate-50/40 transition">
                                <td class="p-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-slate-900 text-white flex items-center justify-center text-xs font-bold">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>
                                        <h5 class="font-bold text-slate-900 text-sm">{{ $user->name }}</h5>
                                    </div>
                                </td>
                                <td class="p-4 font-mono text-slate-500">{{ $user->email }}</td>
                                <td class="p-4">
                                    <span class="bg-indigo-50 text-indigo-700 px-2.5 py-1 rounded-lg text-[10px] font-black tracking-wide border border-indigo-100 uppercase">
                                        {{ $user->roles->first()->name ?? 'Tanpa Role' }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    <span class="bg-emerald-50 text-emerald-700 border border-emerald-100 px-2.5 py-0.5 rounded-full text-[10px] font-bold">Aktif</span>
                                </td>
                                <td class="p-4 text-center space-x-1 whitespace-nowrap flex justify-center">
                                    <button type="button" onclick="openEditModal('{{ $user->id }}', '{{ $user->name }}', '{{ $user->email }}', '{{ $user->roles->first()->name ?? '' }}')" class="bg-slate-100 hover:bg-slate-200 text-slate-700 w-7 h-7 rounded-lg transition text-xs border border-slate-200" title="Ubah Data & Role"><i class="fa-solid fa-user-pen"></i></button>
                                    
                                    <form action="{{ route('dashboard.kelolaUser.destroy', $user->id) }}" method="POST" id="delete-form-{{ $user->id }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete({{ $user->id }})" class="bg-rose-50 hover:bg-rose-100 text-rose-600 w-7 h-7 rounded-lg transition text-xs border border-rose-200/60" title="Hapus Akun">
                                            <i class="fa-solid fa-user-slash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-slate-400 italic">Belum ada data pengurus terdaftar.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>

        <div id="userActionModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-slate-950 bg-opacity-50 backdrop-blur-sm" onclick="closeUserModal()"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

                <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-2xl shadow-2xl sm:my-8 sm:align-middle sm:max-w-md sm:w-full border border-slate-200 relative z-50">
                    <div class="bg-white px-6 pt-6 pb-4 border-b border-slate-100 flex justify-between items-center">
                        <h4 class="text-sm font-black text-slate-900 tracking-tight">Daftarkan Otoritas Baru</h4>
                        <button onclick="closeUserModal()" class="text-slate-400 hover:text-slate-600 transition"><i class="fa-solid fa-xmark text-sm"></i></button>
                    </div>

                    <form action="{{ route('dashboard.kelolaUser.store') }}" method="POST" class="p-6 space-y-4 text-xs font-bold">
                        @csrf

                        <div>
                            <label class="block text-slate-700 mb-1.5">Nama Lengkap Pengurus *</label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Ustadz Mukhsin" class="w-full font-medium border @error('name') border-red-500 @else border-slate-200 @enderror rounded-xl p-3 bg-slate-50 focus:outline-none focus:border-indigo-500 transition text-slate-900">
                            @error('name') <span class="text-red-500 text-[10px] block mt-1"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-slate-700 mb-1.5">Alamat Email Resmi *</label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Contoh: mukhsin@pesantren.sch.id" class="w-full font-medium border @error('email') border-red-500 @else border-slate-200 @enderror rounded-xl p-3 bg-slate-50 focus:outline-none focus:border-indigo-500 transition text-slate-900">
                            @error('email') <span class="text-red-500 text-[10px] block mt-1"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-slate-700 mb-1.5">Pilih Peran Tingkat Otoritas *</label>
                            <select name="role" class="w-full border @error('role') border-red-500 @else border-slate-200 @enderror bg-slate-50 p-3 rounded-xl text-slate-700 focus:outline-none focus:border-indigo-500 transition cursor-pointer uppercase">
                                <option value="">-- Pilih Role --</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role') <span class="text-red-500 text-[10px] block mt-1"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-slate-700 mb-1.5">Kata Sandi Awal *</label>
                            <input type="text" name="password" value="{{ old('password', 'PesantrenCore2026') }}" class="w-full font-mono border @error('password') border-red-500 @else border-slate-200 @enderror rounded-xl p-3 bg-slate-50 focus:outline-none focus:border-indigo-500 transition text-slate-900">
                            @error('password') <span class="text-red-500 text-[10px] block mt-1"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</span> @enderror
                        </div>

                        <div class="pt-4 border-t border-slate-100 flex justify-end gap-2.5">
                            <button type="button" onclick="closeUserModal()" class="bg-white hover:bg-slate-100 text-slate-700 px-4 py-2.5 rounded-xl border border-slate-200 transition">Batal</button>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl transition shadow-sm uppercase tracking-wider"><i class="fa-solid fa-user-shield mr-1.5"></i> Sahkan User</button>
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
                        <h4 class="text-sm font-black text-slate-900 tracking-tight">Ubah Data Pengurus</h4>
                        <button onclick="closeEditModal()" class="text-slate-400 hover:text-slate-600 transition"><i class="fa-solid fa-xmark text-sm"></i></button>
                    </div>

                    <form id="editUserForm" method="POST" class="p-6 space-y-4 text-xs font-bold">
                        @csrf
                        @method('PUT')
                        
                        <input type="hidden" name="user_id" id="edit_user_id" value="{{ old('user_id') }}">

                        <div>
                            <label class="block text-slate-700 mb-1.5">Nama Lengkap Pengurus *</label>
                            <input type="text" name="name" id="edit_name" value="{{ old('name') }}" required class="w-full font-medium border border-slate-200 rounded-xl p-3 bg-slate-50 focus:outline-none focus:border-indigo-500 transition text-slate-900">
                        </div>

                        <div>
                            <label class="block text-slate-700 mb-1.5">Alamat Email Resmi *</label>
                            <input type="email" name="email" id="edit_email" value="{{ old('email') }}" required class="w-full font-medium border border-slate-200 rounded-xl p-3 bg-slate-50 focus:outline-none focus:border-indigo-500 transition text-slate-900">
                        </div>

                        <div>
                            <label class="block text-slate-700 mb-1.5">Pilih Peran Tingkat Otoritas *</label>
                            <select name="role" id="edit_role" required class="w-full border border-slate-200 bg-slate-50 p-3 rounded-xl text-slate-700 focus:outline-none focus:border-indigo-500 transition cursor-pointer uppercase">
                                <option value="">-- Pilih Role --</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-slate-700 mb-1.5">Kata Sandi Baru (Kosongkan jika tidak diubah)</label>
                            <input type="text" name="password" placeholder="Ketik sandi baru..." class="w-full font-mono border border-slate-200 rounded-xl p-3 bg-slate-50 focus:outline-none focus:border-indigo-500 transition text-slate-900">
                        </div>

                        <div class="pt-4 border-t border-slate-100 flex justify-end gap-2.5">
                            <button type="button" onclick="closeEditModal()" class="bg-white hover:bg-slate-100 text-slate-700 px-4 py-2.5 rounded-xl border border-slate-200 transition">Batal</button>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl transition shadow-sm uppercase tracking-wider"><i class="fa-solid fa-floppy-disk mr-1.5"></i> Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Modal Controller
        function openUserModal() {
            const modal = document.getElementById('userActionModal');
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeUserModal() {
            const modal = document.getElementById('userActionModal');
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // Buka otomatis modal jika ada Error Validasi dari Laravel
        @if($errors->any())
            openUserModal();
        @endif

        // SweetAlert Flash Messages (Success & Error Umum)
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
                title: 'Akses Ditolak!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#e11d48',
                customClass: { popup: 'rounded-2xl' }
            });
        @endif

        // SweetAlert Konfirmasi Hapus Data
        function confirmDelete(userId) {
            Swal.fire({
                title: 'Hapus Pengguna?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e11d48',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                customClass: { popup: 'rounded-2xl' }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Eksekusi submit form penghapusan
                    document.getElementById('delete-form-' + userId).submit();
                }
            })
        }

        function openEditModal(id, name, email, role) {
            const modal = document.getElementById('editActionModal');
            const form = document.getElementById('editUserForm');
            
            // Set action URL secara dinamis ke rute update
            form.action = `/dashboard/kelola-user/${id}`;
            
            // Masukkan data pengguna ke dalam input form
            document.getElementById('edit_user_id').value = id;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_role').value = role;
            
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeEditModal() {
            const modal = document.getElementById('editActionModal');
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // Buka otomatis modal jika ada Error Validasi dari Laravel
        @if($errors->any())
            // Cek apakah error terjadi pada method PUT (saat edit form)
            @if(old('_method') == 'PUT')
                openEditModal('{{ old("user_id") }}', '{{ old("name") }}', '{{ old("email") }}', '{{ old("role") }}');
            @else
                openUserModal(); // Jika bukan PUT, berarti error saat Tambah user
            @endif
        @endif
    </script>
@endsection