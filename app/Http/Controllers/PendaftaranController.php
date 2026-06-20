<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Mail;

class PendaftaranController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $filter_jenjang = $request->input('jenjang');
        $filter_status = $request->input('status');

        // Memulai query builder dengan filter bersyarat kustom
        $query = Pendaftaran::query();

        if ($search) {
            $query->where('nama_santri', 'like', "%{$search}%");
        }

        if ($filter_jenjang) {
            $query->where('jenjang', $filter_jenjang);
        }

        if ($filter_status) {
            $query->where('status', $filter_status);
        }

        // Ambil data terpilih dengan pagination terintegrasi URL parameter
        $daftar_pendaftar = $query->latest()->paginate(10)->withQueryString();
        
        // Menghitung total data keseluruhan pendaftar dalam database
        $totalPendaftar = Pendaftaran::count();
        $totalTampil = $daftar_pendaftar->count();

        return view('dashboard.pendaftaran.index', compact(
            'daftar_pendaftar', 'totalPendaftar', 'totalTampil', 
            'search', 'filter_jenjang', 'filter_status'
        ));
    }

public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Review,Lolos,Ditolak'
        ]);

        try {
            $pendaftaran = Pendaftaran::findOrFail($id);
            $pendaftaran->update(['status' => $request->status]);

            // PASTIKAN EMAIL WALI TIDAK KOSONG SEBELUM MENGIRIM
            if (in_array($request->status, ['Lolos', 'Ditolak']) && !empty($pendaftaran->email_wali)) {
                
                // Siapkan data untuk dikirim ke template email
                $dataEmail = [
                    'no_registrasi' => $pendaftaran->no_registrasi,
                    'nama_santri'   => $pendaftaran->nama_santri,
                    'nama_wali'     => $pendaftaran->nama_wali,
                    'status'        => $request->status, // 'Lolos' atau 'Ditolak'
                ];
                
                // Gunakan template view 'emails.pengumuman_seleksi'
                \Mail::send('emails.pengumuman_seleksi', $dataEmail, function ($message) use ($pendaftaran) {
                    $message->to($pendaftaran->email_wali)
                            ->subject('Pengumuman Hasil Seleksi PPDB - ' . $pendaftaran->no_registrasi);
                });
            }

            $pesan = 'Status pendaftaran ' . $pendaftaran->nama_santri . ' berhasil diubah menjadi ' . $request->status;
            if(!empty($pendaftaran->email_wali)) {
                $pesan .= '. Email notifikasi telah berhasil dikirim ke orang tua.';
            } else {
                $pesan .= '. (PERINGATAN: Email tidak dikirim karena data email orang tua kosong).';
            }

            return redirect()->route('dashboard.pendaftaran.index')->with('success', $pesan);
        } catch (Exception $e) {
            return back()->with('error', 'Gagal memproses status atau email tidak terkirim: ' . $e->getMessage());
        }
    }
}