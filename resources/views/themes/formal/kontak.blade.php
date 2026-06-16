@extends('themes.formal.layouts.app')

@section('content')
    
    <!-- Page Header -->
    <section class="bg-emerald-950 text-white py-12 px-4 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('https://images.unsplash.com/photo-1590075865003-e48277adc558')] bg-cover bg-center mix-blend-overlay"></div>
        <div class="relative max-w-7xl mx-auto text-center md:text-left flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold tracking-tight">Hubungi Kontak</h2>
                <p class="text-emerald-300 text-xs mt-1">Hubungi sekretariat pendaftaran atau kirim pesan langsung kepada kami</p>
            </div>
            <div class="text-xs text-emerald-400 bg-emerald-900/50 px-4 py-2 rounded border border-emerald-800/60">
                <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a> 
                <span class="mx-2 text-gray-500">/</span> 
                <span class="text-white">Kontak</span>
            </div>
        </div>
    </section>

    <!-- Seksi Utama Kontak -->
    <section class="py-16 px-4 bg-white">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            
            <!-- KOLOM KIRI: FORMULIR HUBUNGI KAMI (7 Kolom) -->
            <div class="lg:col-span-7 bg-gray-50 p-6 md:p-8 rounded-2xl border border-gray-100 shadow-sm">
                <h3 class="text-xl font-bold text-gray-900 tracking-tight mb-2">Kirim Pesan Langsung</h3>
                <p class="text-xs text-gray-500 mb-6">Miliki pertanyaan seputar pendaftaran santri baru atau lainnya? Silakan isi form di bawah ini.</p>
                
                <!-- INTEGRASI FORM ROUTE POST & CSRF PROTECTION -->
                <form action="{{ route('kontak.kirim') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Nama Lengkap *</label>
                            <input type="text" name="nama" value="{{ old('nama') }}" required placeholder="Masukkan nama Anda" class="w-full text-xs border border-gray-200 rounded-lg p-3 bg-white focus:outline-none focus:border-emerald-600 transition font-medium text-slate-800">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Alamat Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="contoh@email.com" class="w-full text-xs border border-gray-200 rounded-lg p-3 bg-white focus:outline-none focus:border-emerald-600 transition font-medium text-slate-800">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">No. WhatsApp / HP *</label>
                            <input type="tel" name="whatsapp" value="{{ old('whatsapp') }}" required placeholder="0812345678xx" class="w-full text-xs border border-gray-200 rounded-lg p-3 bg-white focus:outline-none focus:border-emerald-600 transition font-medium text-slate-800">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Subjek / Perihal *</label>
                            <input type="text" name="subjek" value="{{ old('subjek') }}" required placeholder="Pendaftaran / Informasi Umum" class="w-full text-xs border border-gray-200 rounded-lg p-3 bg-white focus:outline-none focus:border-emerald-600 transition font-medium text-slate-800">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1.5">Isi Pesan Anda *</label>
                        <textarea name="pesan" required rows="4" placeholder="Tuliskan detail pertanyaan atau pesan Anda di sini..." class="w-full text-xs border border-gray-200 rounded-lg p-3 bg-white focus:outline-none focus:border-emerald-600 transition resize-none font-light text-slate-700 leading-relaxed">{{ old('pesan') }}</textarea>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full sm:w-auto bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold px-6 py-3.5 rounded-lg shadow transition tracking-wide uppercase">
                            <i class="fa-regular fa-paper-plane mr-1.5"></i> Kirim Pesan
                        </button>
                    </div>
                </form>
            </div>

            <!-- KOLOM KANAN: INFORMASI UTAMA & JAM KERJA (5 Kolom) -->
            <div class="lg:col-span-5 space-y-6">
                <!-- Box Informasi Kontak Dinamis -->
                <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm space-y-4">
                    <h4 class="font-bold text-gray-900 text-base border-b border-gray-100 pb-3">Informasi Sekretariat</h4>
                    
                    <div class="flex gap-4 items-start text-xs">
                        <div class="w-8 h-8 bg-emerald-50 rounded-lg flex items-center justify-center text-emerald-800 shrink-0 mt-0.5">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-gray-800 mb-0.5">Alamat Komplek</h5>
                            <p class="text-gray-500 leading-relaxed font-light">
                                {{ $profilSettings['kontak_alamat'] ?? 'Jl. Pendidikan No. 45, Kecamatan Tamalanrea, Kota Makassar, Sulawesi Selatan.' }}
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4 items-start text-xs">
                        <div class="w-8 h-8 bg-emerald-50 rounded-lg flex items-center justify-center text-emerald-800 shrink-0 mt-0.5">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-gray-800 mb-0.5">Layanan Telepon/WA</h5>
                            <p class="text-gray-500 font-light">{{ $profilSettings['kontak_telp_tu'] ?? '+62 812-3456-7890' }} (Tata Usaha)</p>
                            <p class="text-gray-500 font-light">{{ $profilSettings['kontak_telp_ppdb'] ?? '+62 812-9876-5432' }} (Panitia PPDB)</p>
                        </div>
                    </div>

                    <div class="flex gap-4 items-start text-xs">
                        <div class="w-8 h-8 bg-emerald-50 rounded-lg flex items-center justify-center text-emerald-800 shrink-0 mt-0.5">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-gray-800 mb-0.5">Email Resmi</h5>
                            <p class="text-gray-500 font-light">{{ $profilSettings['kontak_email'] ?? 'info@pesandren-dummy.sch.id' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Box Jam Pelayanan Dinamis -->
                <div class="bg-emerald-950 text-white rounded-2xl p-6 shadow-md space-y-3 relative overflow-hidden">
                    <div class="absolute -right-6 -bottom-6 text-emerald-900/40 text-7xl"><i class="fa-regular fa-clock"></i></div>
                    <h4 class="font-bold text-sm tracking-wider uppercase text-emerald-400">Jam Layanan Kantor</h4>
                    <div class="text-xs space-y-2 border-t border-emerald-800/60 pt-3 relative z-10 font-light">
                        <div class="flex justify-between border-b border-emerald-900/40 pb-2">
                            <span>Hari Layanan</span>
                            <span class="font-semibold text-amber-400">{{ $profilSettings['kontak_jam_kerja'] ?? 'Sabtu - Kamis (07.30 - 14.30 WITA)' }}</span>
                        </div>
                        <div class="flex justify-between text-emerald-300 text-[11px] pt-0.5">
                            <span>Hari Jumat</span>
                            <span class="font-bold text-red-400 uppercase tracking-wide">Libur Kantor</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- SEKSI GOOGLE MAPS EMBED DINAMIS -->
    <section class="w-full h-96 bg-gray-200 border-t border-gray-100">
        <iframe 
            src="{{ $profilSettings['kontak_gmaps'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1m4!1s0x2dbefec0!2sMakassar%2C+South+Sulawesi!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbef02772591605%3A0x3030bfbcaf70100!2sMakassar%2C+Makassar+City%2C+South+Sulawesi!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid' }}" 
            class="w-full h-full" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </section>

    <!-- INJEKSI SWEETALERT2 POP-UP ALERTS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Pesan Terkirim!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#047857',
                customClass: { popup: 'rounded-2xl' }
            });
        @endif

        @if($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Gagal Validasi!',
                text: 'Pastikan seluruh kolom wajib bertanda bintang (*) telah terisi dengan benar.',
                confirmButtonColor: '#e11d48',
                customClass: { popup: 'rounded-2xl' }
            });
        @endif
    </script>
@endsection