@extends('themes.islam.layouts.app')

@section('content')
    
    <section class="relative bg-emerald-950 text-white py-28 px-4 text-center overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('https://images.unsplash.com/photo-1542838132-92c53300491e')] bg-cover bg-center mix-blend-overlay"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-emerald-950/80"></div>
        
        <div class="relative max-w-4xl mx-auto z-10">
            <div class="text-amber-400 text-2xl mb-3 font-serif">﷽</div>
            <span class="text-amber-400 font-serif italic text-sm md:text-base block mb-3 tracking-wide">Selamat Datang di Portal Resmi</span>
            <h2 class="font-serif text-3xl md:text-5xl font-bold tracking-wide mb-6 leading-tight text-white">
                Mencetak Santri Tafaqquh Fiddin <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-yellow-200 to-amber-400 font-medium">Berakhlak Karimah & Berjiwa Mandiri</span>
            </h2>
            <p class="text-gray-300 max-w-2xl mx-auto text-sm md:text-base mb-8 leading-relaxed font-light">
                Asrama pusat penempaan ilmu syar'i, hafalan Al-Qur'an, dan pembentukan karakter islami bersandarkan manhaj Ahlussunnah wal Jama'ah.
            </p>
            <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                <a href="{{ route('profil') }}" class="w-full sm:w-auto bg-emerald-800 hover:bg-emerald-700 text-amber-300 font-bold px-8 py-3.5 rounded-xl shadow-lg border border-amber-500/40 transition text-sm tracking-wide">
                    Mengenal Ma'had
                </a>
                
                {{-- SAKLAR AKSES PAKET: MODUL PPDB ONLINE BANNER BUTTON --}}
                @if ($setting->feature_ppdb)
                <a href="{{ route('pendaftaran') }}" class="w-full sm:w-auto bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-emerald-950 font-extrabold px-8 py-3.5 rounded-xl shadow-xl transition text-sm tracking-wide flex items-center justify-center gap-2 border border-yellow-300">
                    <i class="fa-solid fa-door-open"></i> Pendaftaran Santri Baru
                </a>
                @endif
            </div>
        </div>
    </section>

    <!-- SEKSI SAMBUTAN PENGASUH (Dinamis CMS Admin) -->
    <section class="py-20 px-4 bg-white relative">
        <div class="absolute top-0 inset-x-0 h-2 bg-gradient-to-r from-amber-400 via-transparent to-amber-400"></div>
        
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-4 text-center">
                <div class="w-60 h-72 bg-emerald-50 rounded-t-full rounded-b-xl mx-auto shadow-xl overflow-hidden border-4 border-amber-400/40 relative flex items-center justify-center">
                    @if(isset($profilSettings['sambutan_foto']))
                        <img src="{{ asset('storage/' . $profilSettings['sambutan_foto']) }}" alt="KH. Ahmad Mustofa, M.Pd" class="w-full h-full object-cover">
                    @else
                        <i class="fa-solid fa-user-tie text-6xl text-emerald-900/20"></i>
                    @endif
                </div>
                <h4 class="font-serif font-bold text-emerald-950 mt-5 text-lg">KH. Ahmad Mustofa, M.Pd</h4>
                <p class="text-xs text-amber-600 font-bold uppercase mt-1 tracking-widest">Khadimul Ma'had Pascasarjana</p>
            </div>
            <div class="lg:col-span-8">
                <div class="flex items-center gap-2 mb-2">
                    <div class="w-6 h-px bg-amber-500"></div>
                    <span class="text-xs font-bold uppercase tracking-widest text-amber-600 block">Kalimat Tasyakur</span>
                    <div class="w-6 h-px bg-amber-500"></div>
                </div>
                <h3 class="font-serif text-2xl md:text-3xl font-bold text-emerald-950 mb-4 tracking-tight">Sambutan Pengasuh Pondok Pesantren</h3>
                
                {{-- Merender isi teks sambutan yang diketik dari admin dashboard --}}
                <div class="text-gray-600 leading-relaxed text-sm md:text-base space-y-4 font-light">
                    @if(isset($profilSettings['sejarah_teks']))
                        {{-- Menggunakan nl2br agar enter / baris baru dari textarea terjaga rapi --}}
                        {!! nl2br(e($profilSettings['sejarah_teks'])) !!}
                    @else
                        <p class="italic font-medium">"Assalamu’alaikum Warahmatullahi Wabarakatuh. Segala puji khadirat Allah Swt, shalawat beserta salam semoga senantiasa tercurahkan kepada junjungan kita Nabi Besar Muhammad Saw."</p>
                        <p>Pondok pesantren adalah benteng pertahanan akhlak umat Islam. Di tempat mulia ini, putra-putri Anda tidak hanya diajarkan ilmu pengetahuan umum, namun yang utama adalah dibimbing hatinya untuk mengenal Allah, mencintai Rasulullah, serta memahami syariat Islam secara kaffah melalui jalur sanad keilmuan yang muktabar.</p>
                        <p>Selamat bergabung menjadi bagian dari keluarga besar pejuang peradaban Islam. Wassalamu’alaikum Warahmatullahi Wabarakatuh.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- ETALASE DINAMIS BERITA & KEGIATAN -->
    <section class="py-16 px-4 bg-white border-t border-b border-slate-100">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col sm:flex-row justify-between items-center sm:items-end mb-10 border-b border-emerald-900/10 pb-4 gap-4">
                <div class="text-center sm:text-left">
                    <span class="text-xs font-bold uppercase tracking-widest text-amber-600 block mb-1">Kilas Warta</span>
                    <h3 class="font-serif text-2xl font-bold text-emerald-950 tracking-wide">Berita & Catatan Kegiatan</h3>
                </div>
                <a href="{{ route('berita') }}" class="text-xs font-bold text-emerald-900 hover:text-amber-600 bg-white px-4 py-2 rounded-lg shadow-sm border border-emerald-900/5 flex items-center gap-1 transition">
                    Buka Arsip Warta <i class="fa-solid fa-angle-right text-[10px]"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse ($berita as $item)
                <div class="bg-white rounded-2xl shadow-sm border border-emerald-900/5 overflow-hidden hover:shadow-md transition duration-300 flex flex-col justify-between">
                    <div class="h-48 bg-slate-50 flex items-center justify-center text-emerald-900/20 relative overflow-hidden">
                        @if($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover">
                        @else
                            <i class="fa-regular fa-image text-4xl text-slate-300"></i>
                        @endif
                        <span class="absolute bottom-3 left-3 bg-emerald-900 text-amber-400 text-[10px] font-bold px-2.5 py-1 rounded-md border border-amber-500/20 whitespace-nowrap">{{ $item->kategori }}</span>
                    </div>
                    <div class="p-6 flex-grow flex flex-col justify-between">
                        <div class="space-y-2">
                            <div class="text-[11px] text-gray-400 flex items-center gap-2 mb-2 font-semibold">
                                <span><i class="fa-regular fa-calendar mr-1 text-amber-500"></i> {{ $item->created_at->translatedFormat('d F Y') }}</span>
                            </div>
                            <h4 class="font-serif font-bold text-emerald-950 text-base hover:text-amber-600 cursor-pointer line-clamp-2" title="{{ $item->judul }}">
                                {{ $item->judul }}
                            </h4>
                            <p class="text-gray-500 text-xs leading-relaxed line-clamp-3">
                                {{ strip_tags($item->isi) }}
                            </p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-1 md:col-span-3 bg-slate-50 border border-slate-200 rounded-2xl p-12 text-center text-slate-400 italic font-medium">
                    Belum ada publikasi berita atau catatan kegiatan operasional pesantren saat ini.
                </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- SAKLAR AKSES PAKET: MODUL AKORDION TANYA JAWAB (FAQ AREA) --}}
    @if ($setting->feature_faq)
    <section class="py-16 px-4 bg-[#fcfbf7]">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <span class="text-xs font-bold uppercase tracking-widest text-amber-600 block mb-1">Tanya Jawab Ringkas</span>
                <h3 class="font-serif text-2xl font-bold text-emerald-950 tracking-wide">Istifham (FAQ) Seputar Pondok</h3>
                <div class="w-16 h-0.5 bg-amber-500 mx-auto mt-3"></div>
            </div>

            <!-- AREA LOOPING AKORDION TIMELINE FAQ DINAMIS -->
            <div class="space-y-4">
                @forelse($faqs as $item)
                <div class="border border-emerald-900/10 rounded-xl p-4 bg-white hover:border-amber-400 transition shadow-sm group">
                    <h4 class="font-serif font-bold text-sm text-emerald-950 flex justify-between items-center cursor-pointer" onclick="this.nextElementSibling.classList.toggle('hidden'); this.querySelector('i').classList.toggle('fa-circle-chevron-up')">
                        <span><i class="fa-regular fa-comments mr-2 text-amber-500"></i> {{ $item->pertanyaan }}</span>
                        <i class="fa-solid fa-circle-chevron-down text-xs text-amber-500 transition-transform"></i>
                    </h4>
                    <p class="text-xs text-gray-600 mt-2.5 leading-relaxed border-t border-gray-100 pt-2 hidden transition-all duration-300">
                        {!! nl2br(e($item->jawaban)) !!}
                    </p>
                </div>
                @empty
                <div class="bg-white border border-dashed border-emerald-900/20 rounded-xl p-8 text-center text-xs text-gray-400 italic">
                    Belum ada butir pertanyaan FAQ taktis yang diterbitkan saat ini.
                </div>
                @endforelse
            </div>
        </div>
    </section>
    @endif
    
@endsection