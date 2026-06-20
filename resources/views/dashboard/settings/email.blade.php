@extends('layouts.dashboard')

@section('content')
<main class="grow flex flex-col min-w-0 p-6">
    <header class="mb-6">
        <h3 class="text-slate-900 font-black text-xl tracking-tight">Konfigurasi Email Notifikasi</h3>
        <p class="text-slate-500 text-sm mt-1">Atur alamat email sekolah untuk menerima notifikasi saat ada pendaftar PPDB baru.</p>
    </header>

    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm max-w-2xl">
        <form action="{{ route('dashboard.settings.email.update') }}" method="POST">
            @csrf
            <div class="mb-5">
                <label class="block text-sm font-bold text-slate-700 mb-2">Email Admin Sekolah / Pesantren *</label>
                <input type="email" name="admin_email" value="{{ $setting->admin_email ?? old('admin_email') }}" placeholder="admin@pesantren.com" required class="w-full border border-slate-300 rounded-xl px-4 py-3 bg-slate-50 focus:outline-none focus:border-indigo-500 focus:bg-white transition">
                <span class="text-xs text-slate-400 block mt-2">Email ini akan menerima tembusan (BCC) setiap kali ada calon santri yang mendaftar.</span>
            </div>
            
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-6 py-3 rounded-xl shadow-sm transition">
                <i class="fa-solid fa-save mr-2"></i> Simpan Konfigurasi
            </button>
        </form>
    </div>
</main>
@endsection