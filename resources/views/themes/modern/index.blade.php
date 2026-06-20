@extends('themes.modern.layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-4 pt-12 pb-20">
        <div class="bg-gradient-to-br from-slate-950 via-indigo-950 to-slate-900 text-white rounded-3xl p-8 md:p-16 relative overflow-hidden shadow-2xl">
            <div class="absolute inset-0 opacity-5 bg-[url('https://www.transparenttextures.com/patterns/grid-me.png')]"></div>
            <div class="absolute -right-20 -top-20 w-80 h-80 bg-cyan-500/10 rounded-full blur-3xl"></div>
            <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-teal-500/10 rounded-full blur-3xl"></div>

            <div class="relative max-w-3xl z-10">
                <div class="inline-flex items-center gap-2 bg-white/5 border border-white/10 px-3 py-1.5 rounded-full text-[10px] font-bold tracking-widest uppercase text-cyan-400 mb-6 backdrop-blur-sm">
                    <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span> Penerimaan Santri Baru Dibuka
                </div>
                <h2 class="text-3xl md:text-6xl font-black tracking-tight mb-6 leading-tight">
                    Membentuk Generasi <br class="hidden md:inline">
                    Muslim Masa Depan <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-teal-400">Berbasis Sains &amp; Iman</span>
                </h2>
                <p class="text-slate-400 text-sm md:text-base max-w-xl mb-8 leading-relaxed font-light">
                    Ekosistem pendidikan Islam terpadu yang memadukan keilmuan teknologi modern, penguasaan bahasa asing aktif, dan penanaman karakter adab Qur'ani yang kokoh.
                </p>
                
                <div class="flex flex-col sm:flex-row items-center gap-4">
                    <a href="{{ route('pendidikan') }}" class="w-full sm:w-auto bg-teal-500 hover:bg-teal-600 text-slate-950 font-bold px-8 py-4 rounded-xl shadow-lg shadow-teal-500/20 transition text-center text-xs tracking-wider uppercase">
                        Jelajahi Program
                    </a>
                    
                    @if($setting->feature_ppdb)
                    <a href="{{ route('pendaftaran') }}" class="w-full sm:w-auto bg-white/5 hover:bg-white/10 text-white font-semibold px-8 py-4 rounded-xl border border-white/10 transition text-center text-xs tracking-wider uppercase flex items-center justify-center gap-2">
                        Pendaftaran Online <i class="fa-solid fa-arrow-right text-[10px] text-cyan-400"></i>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Seksi Sambutan Direktur Pendidikan (Dinamis CMS) -->
    <section class="max-w-7xl mx-auto px-4 py-12 bg-white rounded-3xl border border-slate-200/50 shadow-sm mb-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center p-4 md:p-8">
            <div class="lg:col-span-4 text-center lg:text-left">
                <div class="w-52 h-52 bg-slate-50 rounded-2xl shadow-inner mx-auto lg:mx-0 overflow-hidden border border-slate-200 flex items-center justify-center relative">
                    @if(isset($profilSettings['sambutan_foto']) && !empty($profilSettings['sambutan_foto']))
                        <img src="{{ asset('storage/' . $profilSettings['sambutan_foto']) }}" alt="Direktur Pendidikan" class="w-full h-full object-cover">
                    @else
                        <i class="fa-solid fa-user-gear text-5xl text-slate-300"></i>
                    @endif
                </div>
                <h4 class="font-extrabold text-slate-900 mt-4 text-base">{{ $profilSettings['sambutan_nama'] ?? 'Dr. H. Ahmad Mustofa, M.T.' }}</h4>
                <p class="text-xs text-teal-600 font-semibold tracking-wider mt-0.5 uppercase">{{ $profilSettings['sambutan_jabatan'] ?? 'Direktur Pendidikan' }}</p>
            </div>
            <div class="lg:col-span-8">
                <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400 block mb-2">Sambutan Pengasuh</span>
                <h3 class="text-xl md:text-2xl font-black text-slate-900 mb-4 tracking-tight">Transformasi Pendidikan Islam di Era Digital</h3>
                <div class="text-slate-500 leading-relaxed text-sm md:text-base font-light space-y-4">
                    @if(isset($profilSettings['sambutan_teks']) && !empty($profilSettings['sambutan_teks']))
                        {!! nl2br(e($profilSettings['sambutan_teks'])) !!}
                    @else
                        <p>"Peradaban bergerak sangat cepat menuju digitalisasi penuh. Pesantren Darussalam Modern berkomitmen penuh menyediakan lingkungan belajar yang relevan dengan tantangan global. Kami mendidik santri bukan sekadar untuk menjadi pengguna teknologi, melainkan menjadi inovator masa depan yang tetap menjunjung tinggi adab dan nilai-nilai Al-Qur'an."</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Seksi Berita & Informasi (Dinamis CMS Grid) -->
    <section class="max-w-7xl mx-auto px-4 py-12 mb-16">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mb-10 gap-4 border-b border-slate-200 pb-4">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-widest text-teal-600 block mb-1">Informasi Terbaru</span>
                <h3 class="text-2xl font-black text-slate-900 tracking-tight">Kabar &amp; Kegiatan Kampus</h3>
            </div>
            <a href="{{ route('berita') }}" class="text-xs font-bold text-slate-900 hover:text-teal-600 flex items-center gap-1.5 transition">
                Lihat Semua Berita <i class="fa-solid fa-arrow-right-long text-[10px]"></i>
            </a>
        </div>

        <!-- Grid Cards Berita Dinamis -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse ($berita as $item)
            <div class="bg-white rounded-2xl border border-slate-200/60 overflow-hidden hover:border-slate-300 hover:shadow-xl transition duration-300 flex flex-col justify-between">
                <div>
                    <div class="h-44 bg-slate-100 flex items-center justify-center text-slate-300 border-b border-slate-100 relative overflow-hidden">
                        @if($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover">
                        @else
                            <i class="fa-regular fa-image text-3xl"></i>
                        @endif
                        <span class="absolute top-4 left-4 bg-slate-900 text-cyan-400 text-[9px] font-bold px-2.5 py-1 rounded-md uppercase tracking-wider">{{ $item->kategori }}</span>
                    </div>
                    <div class="p-6">
                        <div class="text-[10px] text-slate-400 flex items-center gap-2 mb-2 font-semibold">
                            <span><i class="fa-regular fa-calendar mr-1"></i> {{ $item->created_at->translatedFormat('d F Y') }}</span>
                        </div>
                        <h4 class="font-bold text-slate-900 text-base mb-2 hover:text-teal-600 cursor-pointer line-clamp-2 transition" title="{{ $item->judul }}">
                            {{ $item->judul }}
                        </h4>
                        <p class="text-slate-500 text-xs leading-relaxed font-light line-clamp-3">
                            {{ strip_tags($item->isi) }}
                        </p>
                    </div>
                </div>
                <a href="{{ route('berita') }}" class="p-6 pt-0 text-xs font-bold text-teal-600 flex items-center gap-1 hover:underline">
                    Baca Artikel <i class="fa-solid fa-angle-right text-[9px]"></i>
                </a>
            </div>
            @empty
            <div class="col-span-1 md:col-span-3 bg-white border border-dashed border-slate-200 rounded-2xl p-12 text-center text-slate-400 italic font-light">
                Belum ada berkas publikasi kabar berita kampus yang diterbitkan saat ini.
            </div>
            @endforelse
        </div>
    </section>

    <!-- SAKLAR FITUR: FAQ PREMIUM SECTION (Dinamis Accordion) -->
    @if($setting->feature_faq)
    <section class="max-w-4xl mx-auto px-4 py-12 mb-16">
        <div class="text-center mb-10">
            <span class="text-[10px] font-bold uppercase tracking-widest text-teal-600 block mb-1">Tanya Jawab</span>
            <h3 class="text-2xl font-black text-slate-900 tracking-tight">Pertanyaan Umum (FAQ)</h3>
            <div class="w-8 h-1 bg-teal-500 mx-auto mt-3 rounded-full"></div>
        </div>

        <div class="space-y-3">
            @forelse($faqs as $item)
            <div class="border border-slate-200 bg-white rounded-xl p-4 hover:border-slate-300 transition shadow-sm">
                <h4 class="font-bold text-sm text-slate-900 flex justify-between items-center cursor-pointer" onclick="this.nextElementSibling.classList.toggle('hidden');">
                    <span><i class="fa-regular fa-comment-dots mr-2 text-teal-600"></i> {{ $item->pertanyaan }}</span>
                    <i class="fa-solid fa-plus text-xs text-teal-600"></i>
                </h4>
                <p class="text-xs text-slate-500 mt-2 leading-relaxed border-t border-slate-100 pt-2 font-light hidden whitespace-pre-line">
                    {{ $item->jawaban }}
                </p>
            </div>
            @empty
            <div class="bg-white border border-dashed border-slate-200 rounded-xl p-8 text-center text-xs text-slate-400 italic font-light">
                Belum ada komponen tanya jawab FAQ taktis yang dikonfigurasi saat ini.
            </div>
            @endforelse
        </div>
    </section>
    @endif
@endsection