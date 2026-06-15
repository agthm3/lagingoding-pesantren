@extends('layouts.dashboard')

@section('content')
<main class="grow flex flex-col min-w-0">
    <header class="bg-white border-b border-slate-200/60 px-6 py-4 flex justify-between items-center sticky top-0 z-30 shadow-sm">
        <h3 class="text-slate-900 font-black text-sm md:text-base tracking-tight">Kelola Tanya Jawab Ringkas (FAQ)</h3>
    </header>

    <div class="p-6 overflow-y-auto grow grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        
        <!-- KOLOM KIRI: FORMULIR ENTRY FAQ BARU (4 Kolom) -->
        <section class="lg:col-span-4 bg-white border border-slate-200 rounded-2xl p-5 shadow-sm space-y-4 sticky top-20">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-widest text-indigo-600 block mb-0.5">Materi Istifham</span>
                <h4 class="text-xs font-black text-slate-900 tracking-tight">Tambah Baris FAQ Baru</h4>
            </div>

            <form action="{{ route('dashboard.faq.store') }}" method="POST" class="space-y-4 text-xs font-bold">
                @csrf
                <div>
                    <label class="block text-slate-700 mb-1.5">Redaksi Pertanyaan Umum *</label>
                    <input type="text" name="pertanyaan" required placeholder="Contoh: Bagaimana syarat mutlak pendaftaran?" class="w-full border border-slate-200 rounded-xl p-3 bg-slate-50 focus:outline-none focus:border-indigo-500 focus:bg-white font-medium text-slate-800">
                </div>
                <div>
                    <label class="block text-slate-700 mb-1.5">Redaksi Jawaban Penjelasan *</label>
                    <textarea name="jawaban" rows="5" required placeholder="Tuliskan jawaban klarifikasi secara ringkas dan informatif..." class="w-full border border-slate-200 rounded-xl p-3 bg-slate-50 focus:outline-none focus:border-indigo-500 focus:bg-white font-medium text-slate-600 leading-relaxed resize-none"></textarea>
                </div>
                <button type="submit" class="w-full bg-slate-900 hover:bg-slate-800 text-white font-bold p-3.5 rounded-xl transition uppercase tracking-wider">
                    <i class="fa-solid fa-plus mr-1.5 text-cyan-400"></i> Terbitkan FAQ
                </button>
            </form>
        </section>

        <!-- KOLOM KANAN: LIST DATA FAQ & EDIT MODAL AREA (8 Kolom) -->
        <section class="lg:col-span-8 space-y-4 w-full">
            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-xl text-xs font-bold shadow-sm">{{ session('success') }}</div>
            @endif

            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                <table class="w-full text-left text-xs border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100 text-slate-400 font-bold uppercase tracking-wider">
                            <th class="p-4 w-12 text-center">No</th>
                            <th class="p-4">Pertanyaan &amp; Jawaban</th>
                            <th class="p-4 text-center w-28">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                        @forelse($faqs as $index => $item)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="p-4 text-center text-slate-400 font-mono">{{ $index + 1 }}</td>
                            <td class="p-4 space-y-1.5 max-w-lg">
                                <div class="text-slate-900 font-black text-sm"><i class="fa-regular fa-circle-question text-indigo-500 mr-1"></i> {{ $item->pertanyaan }}</div>
                                <p class="text-slate-500 font-light leading-relaxed whitespace-pre-wrap">{{ $item->jawaban }}</p>
                            </td>
                            <td class="p-4">
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick="openEditModal({{ $item->id }}, '{{ addslashes($item->pertanyaan) }}', '{{ addslashes($item->jawaban) }}')" class="border border-slate-200 text-slate-600 hover:text-indigo-600 hover:border-indigo-100 p-2 rounded-xl transition bg-white shadow-sm">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </button>
                                    <form action="{{ route('dashboard.faq.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus permanen FAQ ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="border border-slate-200 text-slate-400 hover:text-red-500 hover:border-red-100 p-2 rounded-xl transition bg-white shadow-sm">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="p-12 text-center text-slate-400 font-light italic bg-slate-50/40">Daftar Tanya Jawab FAQ masih kosong.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</main>

<!-- BACKDROP MODAL DIALOG EDIT FAQ -->
<div id="editModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-xl space-y-4 border border-slate-100 transform transition">
        <div class="flex justify-between items-center border-b border-slate-100 pb-3">
            <h4 class="text-sm font-black text-slate-900 uppercase tracking-tight"><i class="fa-regular fa-pen-to-square mr-1 text-indigo-600"></i> Perbarui Tanya Jawab FAQ</h4>
            <button onclick="closeEditModal()" class="text-slate-400 hover:text-slate-600 transition text-lg"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <form id="editForm" method="POST" class="space-y-4 text-xs font-bold">
            @csrf @method('PUT')
            <div>
                <label class="block text-slate-700 mb-1.5">Redaksi Pertanyaan *</label>
                <input type="text" id="edit_pertanyaan" name="pertanyaan" required class="w-full border border-slate-200 rounded-xl p-3 focus:outline-none focus:border-indigo-500 font-medium text-slate-800 shadow-sm">
            </div>
            <div>
                <label class="block text-slate-700 mb-1.5">Redaksi Jawaban Penjelasan *</label>
                <textarea id="edit_jawaban" name="jawaban" rows="5" required class="w-full border border-slate-200 rounded-xl p-3 focus:outline-none focus:border-indigo-500 font-medium text-slate-600 leading-relaxed resize-none shadow-sm"></textarea>
            </div>
            <div class="flex justify-end gap-2 border-t border-slate-100 pt-3">
                <button type="button" onclick="closeEditModal()" class="border border-slate-200 hover:bg-slate-50 text-slate-600 px-4 py-2.5 rounded-xl transition">Batal</button>
                <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white px-5 py-2.5 rounded-xl transition">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal(id, pertanyaan, jawaban) {
        document.getElementById('editForm').action = `{{ url('dashboard/faq') }}/${id}`;
        document.getElementById('edit_pertanyaan').value = pertanyaan;
        document.getElementById('edit_jawaban').value = jawaban;
        document.getElementById('editModal').classList.remove('hidden');
    }
    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }
</script>
@endsection