@extends('themes.formal.layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-emerald-950 text-white overflow-hidden py-24 px-4">
        <div class="absolute inset-0 opacity-15 bg-[url('https://images.unsplash.com/photo-1590075865003-e48277adc558')] bg-cover bg-center mix-blend-overlay"></div>
        
        <div class="relative max-w-5xl mx-auto text-center">
            <span class="bg-emerald-800/60 text-emerald-300 text-xs font-semibold px-3 py-1.5 rounded-full uppercase tracking-wider inline-block mb-4 border border-emerald-700/50">Tahun Ajaran 2026/2027</span>
            <h2 class="text-3xl md:text-5xl font-extrabold tracking-tight mb-6 leading-tight">
                Membentuk Generasi Qur'ani, <br class="hidden md:inline"><span class="text-emerald-400">Berakhlak Mulia &amp; Berwawasan Global</span>
            </h2>
            <p class="text-gray-300 max-w-2xl mx-auto text-base md:text-lg mb-8 leading-relaxed font-light">
                Memadukan kurikulum salafiyah klasik yang otentik dengan sistem pendidikan modern berskala nasional guna melahirkan lulusan yang kompeten dan bertakwa.
            </p>
            <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                <a href="{{ route('profil') }}" class="w-full sm:w-auto bg-emerald-500 hover:bg-emerald-600 text-emerald-950 font-bold px-8 py-3.5 rounded shadow-lg transition tracking-wide text-sm text-center">
                    Jelajahi Profil
                </a>
                
                @if($setting->feature_ppdb)
                <a href="{{ route('pendaftaran') }}" class="w-full sm:w-auto bg-transparent hover:bg-white/10 text-white font-semibold px-8 py-3.5 rounded border border-white/30 transition tracking-wide text-sm flex items-center justify-center gap-2">
                    <i class="fa-solid fa-graduation-cap"></i> Pendaftaran Online
                </a>
                @endif
            </div>
        </div>
    </section>

    <!-- Seksi Sambutan Pimpinan (Dinamis CMS) -->
    <section class="py-16 px-4 bg-white">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-12 gap-12 items-center">
            <div class="md:col-span-4 text-center">
                <div class="w-56 h-72 bg-gray-200 rounded-lg mx-auto shadow-md overflow-hidden border-4 border-white ring-4 ring-emerald-50/50 flex items-center justify-center relative">
                    @if(isset($profilSettings['sambutan_foto']) && !empty($profilSettings['sambutan_foto']))
                        <img src="{{ asset('storage/' . $profilSettings['sambutan_foto']) }}" alt="Foto Pengasuh" class="w-full h-full object-cover">
                    @else
                        <i class="fa-solid fa-user-tie text-5xl text-gray-400"></i>
                    @endif
                </div>
                <h4 class="font-bold text-gray-900 mt-4 text-base">{{ $profilSettings['sambutan_nama'] ?? 'KH. Ahmad Mustofa, M.Pd' }}</h4>
                <p class="text-xs text-emerald-700 font-medium uppercase mt-0.5 tracking-wider">{{ $profilSettings['sambutan_jabatan'] ?? 'Pimpinan Pesantren' }}</p>
            </div>
            <div class="md:col-span-8">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 block mb-2">Kata Pengantar</span>
                <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4 tracking-tight">Sambutan Khadimul Ma'had</h3>
                <div class="w-12 h-1 bg-emerald-600 mb-6"></div>
                <div class="text-gray-600 leading-relaxed text-sm md:text-base space-y-4 font-light">
                    @if(isset($profilSettings['sambutan_teks']) && !empty($profilSettings['sambutan_teks']))
                        {!! nl2br(e($profilSettings['sambutan_teks'])) !!}
                    @else
                        <p class="italic font-medium">"Assalamu’alaikum Warahmatullahi Wabarakatuh. Segala puji bagi Allah yang telah memberikan kita nikmat iman dan ilmu. Di era digitalisasi ini, Pesantren Darussalam berkomitmen kuat untuk tetap menjaga khazanah keilmuan Islam klasik sembari adaptif terhadap perkembangan teknologi modern."</p>
                        <p>Kami membuka pintu selebar-lebarnya bagi seluruh wali santri dan masyarakat untuk bersinergi bersama dalam mendidik putra-putri kita menjadi benteng umat di masa depan.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Seksi Berita & Informasi (Dinamis Berita) -->
    <section class="py-16 px-4 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-end mb-8 border-b border-gray-200 pb-4">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 block mb-1">Informasi Terbaru</span>
                    <h3 class="text-2xl font-bold text-gray-900 tracking-tight">Berita &amp; Kegiatan</h3>
                </div>
                <a href="{{ route('berita') }}" class="text-sm font-semibold text-emerald-700 hover:text-emerald-800 flex items-center gap-1 transition">
                    Lihat Semua <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>

            <!-- Grid Card Berita Dinamis -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse ($berita as $item)
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition flex flex-col justify-between">
                    <div class="h-48 bg-gray-100 flex items-center justify-center text-gray-400 relative overflow-hidden">
                        @if($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover">
                        @else
                            <i class="fa-regular fa-image text-3xl"></i>
                        @endif
                        <span class="absolute bottom-3 left-3 bg-emerald-800 text-white text-[10px] font-bold px-2.5 py-1 rounded shadow-sm">{{ $item->kategori }}</span>
                    </div>
                    <div class="p-5 flex-grow flex flex-col justify-between">
                        <div class="space-y-2">
                            <div class="text-xs text-gray-400 flex items-center gap-3 font-medium">
                                <span><i class="fa-regular fa-calendar mr-1"></i> {{ $item->created_at->translatedFormat('d M Y') }}</span>
                            </div>
                            <h4 class="font-bold text-gray-800 text-base line-clamp-2 hover:text-emerald-700 cursor-pointer" title="{{ $item->judul }}">
                                {{ $item->judul }}
                            </h4>
                            <p class="text-gray-500 text-xs leading-relaxed line-clamp-3 font-light">
                                {{ strip_tags($item->isi) }}
                            </p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-1 md:col-span-3 bg-white border border-dashed border-gray-200 rounded-xl p-12 text-center text-gray-400 italic font-light">
                    Belum ada publikasi warta berita operasional pesantren saat ini.
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- SAKLAR FITUR: SEKSI FAQ (Dinamis Accordion) -->
    @if($setting->feature_faq)
    <section class="py-16 px-4 bg-white border-t border-gray-100">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-10">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 block mb-1">Pertanyaan Umum</span>
                <h3 class="text-2xl font-bold text-gray-900 tracking-tight">Frequently Asked Questions</h3>
                <div class="w-12 h-1 bg-emerald-600 mx-auto mt-3"></div>
            </div>

            <div class="space-y-4">
                @forelse($faqs as $item)
                <div class="border border-gray-200 rounded-xl p-4 bg-gray-50/50 hover:border-emerald-600 transition">
                    <h4 class="font-bold text-sm text-gray-800 flex justify-between items-center cursor-pointer" onclick="this.nextElementSibling.classList.toggle('hidden');">
                        <span><i class="fa-regular fa-comments mr-2 text-emerald-600"></i> {{ $item->pertanyaan }}</span>
                        <i class="fa-solid fa-chevron-down text-xs text-gray-400"></i>
                    </h4>
                    <p class="text-xs text-gray-600 mt-3 leading-relaxed border-t border-gray-200/60 pt-2.5 hidden font-light whitespace-pre-line">
                        {{ $item->jawaban }}
                    </p>
                </div>
                @empty
                <div class="border border-dashed border-gray-200 rounded-xl p-8 text-center text-xs text-gray-400 italic font-light">
                    Belum ada item tanya jawab FAQ yang diterbitkan oleh admin.
                </div>
                @endforelse
            </div>
        </div>
    </section>
    @endif
@endsection