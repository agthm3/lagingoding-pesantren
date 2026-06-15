@extends('layouts.dashboard')

@section('content')
<main class="grow flex flex-col min-w-0">
    <header class="bg-white border-b border-slate-200/60 px-6 py-4 flex justify-between items-center sticky top-0 z-30 shadow-sm shadow-slate-100/50">
        <h3 class="text-slate-900 font-black text-sm md:text-base tracking-tight">Manajemen Kontak &amp; Informasi Sekretariat</h3>
    </header>

    <div class="p-6 overflow-y-auto grow space-y-8">
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-xl text-xs font-bold shadow-sm">
                <i class="fa-solid fa-circle-check mr-1"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-rose-50 border border-rose-200 text-rose-800 p-4 rounded-xl text-xs font-bold shadow-sm">
                <i class="fa-solid fa-circle-xmark mr-1"></i> {{ session('error') }}
            </div>
        @endif

        <section class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm space-y-4 max-w-5xl w-full">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-widest text-indigo-600 block mb-0.5">Konfigurasi Hubungi Kami</span>
                <h4 class="text-sm font-black text-slate-900 tracking-tight">1. Pengaturan Informasi Biro Sekretariat Pusat &amp; Jam Khidmah</h4>
                <p class="text-xs text-slate-400 font-light mt-0.5">Data yang Anda masukkan di sini akan langsung merubah info alamat, nomor telepon, dan jam kerja pada halaman publik.</p>
            </div>

            <form action="{{ route('dashboard.kontak.update-info') }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label class="block text-[11px] font-bold text-slate-700 mb-1.5">Alamat Lengkap Komplek Ma'had *</label>
                        <input type="text" name="kontak_alamat" value="{{ $settings['kontak_alamat'] ?? 'Jl. Pendidikan No. 45, Kecamatan Tamalanrea, Kota Makassar, Sulawesi Selatan.' }}" required class="w-full text-xs border border-slate-200 rounded-xl p-3 bg-slate-50 focus:outline-none focus:border-indigo-500 focus:bg-white shadow-inner transition text-slate-800 font-medium">
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1.5">Hubungan Telepon Resmi (Biro Tata Usaha) *</label>
                        <input type="text" name="kontak_telp_tu" value="{{ $settings['kontak_telp_tu'] ?? '+62 812-3456-7890' }}" required class="w-full text-xs border border-slate-200 rounded-xl p-3 bg-slate-50 focus:outline-none focus:border-indigo-500 focus:bg-white shadow-inner transition text-slate-800 font-medium">
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1.5">Layanan Maklumat Pendaftaran (PPDB) *</label>
                        <input type="text" name="kontak_telp_ppdb" value="{{ $settings['kontak_telp_ppdb'] ?? '+62 812-9876-5432' }}" required class="w-full text-xs border border-slate-200 rounded-xl p-3 bg-slate-50 focus:outline-none focus:border-indigo-500 focus:bg-white shadow-inner transition text-slate-800 font-medium">
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1.5">Surat Elektronik (Email Resmi) *</label>
                        <input type="email" name="kontak_email" value="{{ $settings['kontak_email'] ?? 'sekretariat@darussalam.mahad.id' }}" required class="w-full text-xs border border-slate-200 rounded-xl p-3 bg-slate-50 focus:outline-none focus:border-indigo-500 focus:bg-white shadow-inner transition text-slate-800 font-medium">
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1.5">Jam &amp; Hari Kerja Khidmah Pelayanan *</label>
                        <input type="text" name="kontak_jam_kerja" value="{{ $settings['kontak_jam_kerja'] ?? 'Sabtu - Kamis (07.30 - 14.30 WITA)' }}" required placeholder="Contoh: Sabtu - Kamis (07.30 - 14.30 WITA)" class="w-full text-xs border border-slate-200 rounded-xl p-3 bg-slate-50 focus:outline-none focus:border-indigo-500 focus:bg-white shadow-inner transition text-slate-800 font-medium">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-[11px] font-bold text-slate-700 mb-1.5"><i class="fa-solid fa-map-location-dot mr-1 text-indigo-600"></i> Link Embed Iframe Google Maps *</label>
                        <textarea name="kontak_gmaps" rows="3" required placeholder="Masukkan hanya isi dari atribut src='...' pada kode embed Google Maps Anda" class="w-full text-xs border border-slate-200 rounded-xl p-3 bg-slate-50 focus:outline-none focus:border-indigo-500 focus:bg-white shadow-inner transition text-slate-800 leading-relaxed font-mono">{{ $settings['kontak_gmaps'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1m4!1s0x2dbefec0!2sMakassar%2C+South+Sulawesi!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbef02772591605%3A0x3030bfbcaf70100!2sMakassar%2C+Makassar+City%2C+South+Sulawesi!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid' }}</textarea>
                        <span class="text-[10px] text-slate-400 mt-1 block font-normal">Cara ambil: Buka Google Maps ➔ Cari Lokasi ➔ Klik Bagikan ➔ Pilih Sematkan Peta ➔ Salin teks URL yang ada di dalam tanda petik atribut <b>src="..."</b> saja.</span>
                    </div>
                </div>

                <div class="flex justify-end pt-2">
                    <button type="submit" class="w-full sm:w-auto bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold px-6 py-3 rounded-xl transition shadow-sm uppercase tracking-wider">
                        <i class="fa-solid fa-floppy-disk mr-1.5 text-indigo-400"></i> Simpan Info Kontak
                    </button>
                </div>
            </form>
        </section>

        <section class="max-w-5xl w-full space-y-3">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400 block mb-0.5">Inbox Hubungi Kami</span>
                <h4 class="text-sm font-black text-slate-900 tracking-tight">2. Daftar Surat Pertanyaan Pengunjung Masuk</h4>
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse text-left text-xs">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100 text-slate-400 font-bold uppercase tracking-wider">
                                <th class="p-4 w-12 text-center">Status</th>
                                <th class="p-4">Pengirim</th>
                                <th class="p-4">Subjek &amp; Isi Pesan</th>
                                <th class="p-4">Tanggal Masuk</th>
                                <th class="p-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700 font-medium">
                            @forelse($pesan as $item)
                                <tr id="row-{{ $item->id }}" class="hover:bg-slate-50/60 transition {{ !$item->is_read ? 'bg-indigo-50/20 font-bold text-slate-900' : '' }}">
                                    <td class="p-4 text-center">
                                        <span id="badge-{{ $item->id }}" class="w-2.5 h-2.5 rounded-full inline-block {{ !$item->is_read ? 'bg-indigo-600' : 'bg-slate-300' }}"></span>
                                    </td>
                                    <td class="p-4 space-y-1">
                                        <div class="text-slate-900 font-bold">{{ $item->nama }}</div>
                                        <div class="text-[10px] text-slate-400 font-normal">{{ $item->email ?? 'Tanpa Email' }}</div>
                                        <div class="text-[10px] text-emerald-600 font-bold font-mono"><i class="fa-brands fa-whatsapp"></i> {{ $item->whatsapp }}</div>
                                    </td>
                                    <td class="p-4 max-w-md">
                                        <div class="text-slate-900 font-black">{{ $item->subjek }}</div>
                                        <p class="text-slate-500 font-light mt-1 whitespace-pre-wrap leading-relaxed">{{ $item->pesan }}</p>
                                    </td>
                                    <td class="p-4 text-slate-400 font-normal">
                                        {{ $item->created_at->translatedFormat('d M Y, H:i') }} WITA
                                    </td>
                                    <td class="p-4">
                                        <div class="flex items-center justify-center gap-2">
                                            @if(!$item->is_read)
                                                <button onclick="markAsRead({{ $item->id }})" class="bg-indigo-600 hover:bg-indigo-700 text-white text-[10px] font-bold px-3 py-1.5 rounded-lg shadow transition">
                                                    Tandai Baca
                                                </button>
                                            @endif
                                            <form action="{{ route('dashboard.kontak.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus permanen pesan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="border border-slate-200 hover:border-red-200 text-slate-400 hover:text-red-500 p-2 rounded-lg transition bg-white shadow-sm">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-12 text-center text-slate-400 italic font-normal bg-slate-50/50">
                                        Kotak pesan masuk silaturahmi kosong. Belum ada kiriman data kontak saat ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</main>

<script>
    function markAsRead(id) {
        fetch(`{{ url('dashboard/kontak-masuk') }}/${id}/read`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                document.getElementById(`row-${id}`).classList.remove('bg-indigo-50/20', 'font-bold', 'text-slate-900');
                document.getElementById(`badge-${id}`).className = "w-2.5 h-2.5 rounded-full inline-block bg-slate-300";
                event.target.remove();
            }
        });
    }
</script>
@endsection