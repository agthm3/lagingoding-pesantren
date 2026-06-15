<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Ma'had Portal</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-white text-slate-700 antialiased flex flex-col justify-between min-h-screen selection:bg-slate-100 selection:text-slate-900">

    <!-- Header Minimalis -->
    <header class="px-6 py-6 border-b border-slate-100/80 bg-white/50 sticky top-0 backdrop-blur-md z-50 flex justify-center">
        <div class="max-w-7xl w-full flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 bg-slate-900 text-white rounded-lg flex items-center justify-center font-bold shadow-sm">
                    <i class="fa-solid fa-cube text-xs"></i>
                </div>
                <span class="text-slate-900 font-extrabold text-xs tracking-tight uppercase">Sistem Portal Pesantren</span>
            </div>
            <a href="{{ url('/') }}" class="text-xs font-bold text-slate-400 hover:text-slate-900 transition flex items-center gap-1.5">
                <i class="fa-solid fa-house-chimney text-[10px]"></i> Beranda Utama
            </a>
        </div>
    </header>

    <!-- Area Utama Konten Error -->
    <main class="grow flex items-center justify-center p-6 bg-white relative overflow-hidden">
        <!-- Dekorasi Grid Pola Transparan Halus -->
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#f1f5f9_1px,transparent_1px),linear-gradient(to_bottom,#f1f5f9_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_50%,#000_70%,transparent_100%)] opacity-40"></div>

        <div class="relative max-w-md w-full text-center space-y-6 z-10 py-12">
            <!-- Lingkaran Kode Status -->
            <div class="w-20 h-20 bg-slate-50 border border-slate-200/60 rounded-3xl mx-auto flex items-center justify-center shadow-sm">
                <span class="text-slate-900 font-black text-2xl tracking-tight">@yield('code')</span>
            </div>

            <!-- Teks Maklumat Status -->
            <div class="space-y-2">
                <h2 class="text-slate-900 font-black text-xl tracking-tight">@yield('message_title')</h2>
                <p class="text-slate-400 text-xs font-light leading-relaxed max-w-sm mx-auto">@yield('message_desc')</p>
            </div>

            <!-- Tombol Navigasi Netral Adaptif -->
            <div class="pt-4 flex flex-col sm:flex-row justify-center items-center gap-3">
                <button onclick="window.history.back()" class="w-full sm:w-auto border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-bold px-5 py-3 rounded-xl transition shadow-sm flex items-center justify-center gap-2">
                    <i class="fa-solid fa-arrow-left text-[10px]"></i> Kembali Ke Halaman Sebelumnya
                </button>
                <a href="{{ url('/') }}" class="w-full sm:w-auto bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold px-6 py-3 rounded-xl transition shadow-md flex items-center justify-center gap-2">
                    Buka Beranda <i class="fa-solid fa-angle-right text-[10px]"></i>
                </a>
            </div>
        </div>
    </main>

    <!-- Footer Clean -->
    <footer class="bg-white border-t border-slate-100 py-6 text-center text-[10px] text-slate-400 font-bold uppercase tracking-wider">
        <p>&copy; {{ date('Y') }} Core Engine Infrastructure SaaS Pesantren. All Rights Reserved.</p>
    </footer>

</body>
</html>