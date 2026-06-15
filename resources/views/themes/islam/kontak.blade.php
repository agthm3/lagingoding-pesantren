@extends('themes.islam.layouts.app')

@section('content')

    <!-- Page Header -->
    <section class="bg-emerald-950 text-white py-16 px-4 relative overflow-hidden text-center">
        <div class="absolute inset-0 opacity-10 bg-[url('https://images.unsplash.com/photo-1542838132-92c53300491e')] bg-cover bg-center mix-blend-overlay"></div>
        <div class="relative max-w-4xl mx-auto z-10">
            <h2 class="font-serif text-2xl md:text-4xl font-bold tracking-wide text-white">Silaturahmi & Istifham</h2>
            <p class="text-amber-400 font-serif italic text-xs md:text-sm mt-2">Pintu komunikasi terbuka bimbingan pendaftaran santri dan sekretariat yayasan</p>
            <div class="inline-flex items-center gap-2 mt-4 text-[11px] text-emerald-300 bg-emerald-900/60 px-4 py-1.5 rounded-full border border-emerald-800/60">
                <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a> 
                <span class="text-emerald-700">/</span> 
                <span class="text-white">Hubungi</span>
            </div>
        </div>
    </section>

    <!-- Seksi Utama Kontak -->
    <section class="py-16 px-4 bg-white">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            
            <!-- KOLOM KIRI: FORMULIR HUBUNGI KAMI (7 Kolom) -->
            <div class="lg:col-span-7 bg-[#fcfbf7] p-6 md:p-8 rounded-2xl border border-emerald-900/5 shadow-sm">
                <h3 class="font-serif text-xl font-bold text-emerald-950 tracking-wide mb-1">Kirim Istifham (Pertanyaan)</h3>
                <p class="text-xs text-gray-500 font-light mb-6">Silakan layangkan pesan atau maklumat pertanyaan Anda melalui lembar formulir di bawah ini.</p>
                
                <!-- DIHUBUNGKAN KE ROUTE POST LARAVEL -->
                <form action="{{ route('kontak.kirim') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-emerald-950 mb-1.5">Nama Lengkap Pemohon *</label>
                            <input type="text" name="nama" value="{{ old('nama') }}" required placeholder="Masukkan nama lengkap Anda" class="w-full text-xs border border-emerald-900/10 rounded-xl p-3 bg-white focus:outline-none focus:border-amber-500 shadow-inner transition text-slate-800 font-medium">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-emerald-950 mb-1.5">Alamat Surat Elektronik (Email)</label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="alamat@email.com" class="w-full text-xs border border-emerald-900/10 rounded-xl p-3 bg-white focus:outline-none focus:border-amber-500 shadow-inner transition text-slate-800 font-medium">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-emerald-950 mb-1.5">No. Sambungan WhatsApp *</label>
                            <input type="tel" name="whatsapp" value="{{ old('whatsapp') }}" required placeholder="08123456xxxx" class="w-full text-xs border border-emerald-900/10 rounded-xl p-3 bg-white focus:outline-none focus:border-amber-500 shadow-inner transition text-slate-800 font-medium">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-emerald-950 mb-1.5">Subjek / Perihal Masalah *</label>
                            <input type="text" name="subjek" value="{{ old('subjek') }}" required placeholder="Contoh: Info PPDB / Agenda Pondok" class="w-full text-xs border border-emerald-900/10 rounded-xl p-3 bg-white focus:outline-none focus:border-amber-500 shadow-inner transition text-slate-800 font-medium">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-emerald-950 mb-1.5">Detail Pesan / Pertanyaan *</label>
                        <textarea name="pesan" required rows="4" placeholder="Tuliskan butir-butir pertanyaan Anda secara ringkas dan jelas di sini..." class="w-full text-xs border border-emerald-900/10 rounded-xl p-3 bg-white focus:outline-none focus:border-amber-500 shadow-inner transition resize-none text-slate-800 leading-relaxed">{{ old('pesan') }}</textarea>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full sm:w-auto bg-emerald-900 hover:bg-emerald-800 text-amber-300 border border-amber-500/30 text-xs font-bold px-6 py-3.5 rounded-xl shadow-md tracking-wider uppercase transition">
                            <i class="fa-regular fa-paper-plane mr-2"></i> Layangkan Pesan
                        </button>
                    </div>
                </form>
            </div>

            <!-- KOLOM KANAN: KANTOR SEKRETARIAT & JAM KERJA (5 Kolom) -->
            <div class="lg:col-span-5 space-y-6">
                <div class="bg-white border border-emerald-900/5 rounded-2xl p-6 shadow-sm space-y-4">
                    <h4 class="font-serif font-bold text-emerald-950 text-base border-b border-gray-100 pb-3">Biro Sekretariat Pusat</h4>
                    
                    <div class="flex gap-4 items-start text-xs">
                        <div class="w-8 h-8 bg-emerald-900/5 text-emerald-900 border border-emerald-900/10 rounded-xl flex items-center justify-center shrink-0 mt-0.5">
                            <i class="fa-solid fa-map-location-dot"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-emerald-950 mb-0.5">Alamat Komplek Ma'had</h5>
                            <p class="text-gray-500 leading-relaxed font-light">Jl. Pendidikan No. 45, Kecamatan Tamalanrea, Kota Makassar, Sulawesi Selatan.</p>
                        </div>
                    </div>

                    <div class="flex gap-4 items-start text-xs">
                        <div class="w-8 h-8 bg-emerald-900/5 text-emerald-900 border border-emerald-900/10 rounded-xl flex items-center justify-center shrink-0 mt-0.5">
                            <i class="fa-solid fa-address-book"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-emerald-950 mb-0.5">Hubungan Telepon Resmi</h5>
                            <p class="text-gray-500 font-light">+62 812-3456-7890 (Biro Tata Usaha)</p>
                            <p class="text-gray-500 font-light">+62 812-9876-5432 (Layanan Maklumat PPDB)</p>
                        </div>
                    </div>

                    <div class="flex gap-4 items-start text-xs">
                        <div class="w-8 h-8 bg-emerald-900/5 text-emerald-900 border border-emerald-900/10 rounded-xl flex items-center justify-center shrink-0 mt-0.5">
                            <i class="fa-solid fa-at"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-emerald-950 mb-0.5">Surat Elektronik</h5>
                            <p class="text-gray-500 font-light">sekretariat@darussalam.mahad.id</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-emerald-950 to-emerald-900 text-white rounded-2xl p-6 shadow-md space-y-3 relative overflow-hidden border border-amber-500/20">
                    <div class="absolute -right-6 -bottom-6 text-emerald-900/30 text-7xl"><i class="fa-solid fa-mosque"></i></div>
                    <h4 class="font-serif font-bold text-sm tracking-wider uppercase text-amber-400">Jam Khidmah Pelayanan</h4>
                    <div class="text-xs space-y-2 border-t border-emerald-800/40 pt-3 relative z-10 font-light">
                        <div class="flex justify-between border-b border-emerald-950/40 pb-2">
                            <span>Sabtu - Kamis</span>
                            <span class="font-bold text-amber-400">07.30 - 14.30 WITA</span>
                        </div>
                        <div class="flex justify-between text-emerald-300">
                            <span>Hari Sunah (Jumat)</span>
                            <span class="font-bold uppercase tracking-wider text-red-400">Libur Kantor</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- SEKSI GOOGLE MAPS EMBED -->
    <section class="w-full h-96 bg-gray-200 border-t-2 border-b-2 border-amber-500/20">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1m4!1s0x2dbefec0!2sMakassar%2C+South+Sulawesi!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbef02772591605%3A0x3030bfbcaf70100!2sMakassar%2C+Makassar+City%2C+South+Sulawesi!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid" 
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
                confirmButtonColor: '#10b981',
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