<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f8fafc; padding: 20px; color: #334155; }
        .container { max-w-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); 
            /* Warna border atas berubah dinamis tergantung status */
            border-top: 4px solid {{ $status == 'Lolos' ? '#10b981' : '#e11d48' }}; 
        }
        .header { text-align: center; border-bottom: 1px solid #e2e8f0; padding-bottom: 20px; margin-bottom: 20px; }
        .title { color: #0f172a; font-size: 22px; font-weight: bold; margin: 0; }
        .content { line-height: 1.6; }
        .status-box { 
            background-color: {{ $status == 'Lolos' ? '#ecfdf5' : '#fff1f2' }}; 
            border: 1px dashed {{ $status == 'Lolos' ? '#10b981' : '#e11d48' }}; 
            color: {{ $status == 'Lolos' ? '#047857' : '#be123c' }}; 
            padding: 15px; text-align: center; border-radius: 8px; margin: 20px 0; font-size: 18px; font-weight: bold; 
        }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 10px; border-bottom: 1px solid #e2e8f0; text-align: left; font-size: 14px; }
        th { width: 40%; color: #64748b; }
        .footer { margin-top: 30px; border-top: 1px solid #e2e8f0; padding-top: 20px; text-align: center; font-size: 12px; color: #94a3b8; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="title">Pengumuman Seleksi Administrasi PPDB</h1>
            <p style="margin: 5px 0 0 0; color: #64748b;">Pesantren Darussalam</p>
        </div>
        <div class="content">
            <p>Assalamu'alaikum Warahmatullahi Wabarakatuh,</p>
            <p>Yth. Bapak/Ibu <strong>{{ $nama_wali }}</strong>,</p>
            <p>Berdasarkan hasil verifikasi berkas oleh panitia Penerimaan Peserta Didik Baru (PPDB), berikut adalah status seleksi untuk calon santri:</p>
            
            <table>
                <tr><th>No. Registrasi</th><td><strong>{{ $no_registrasi }}</strong></td></tr>
                <tr><th>Nama Calon Santri</th><td>{{ $nama_santri }}</td></tr>
            </table>

            <div class="status-box">
                @if($status == 'Lolos')
                    🎉 SELAMAT! BERKAS DITERIMA (LOLOS)
                @else
                    ❌ MOHON MAAF, BERKAS DITOLAK
                @endif
            </div>

            @if($status == 'Lolos')
                <p>Selamat! Berkas ananda telah memenuhi syarat administrasi. Informasi mengenai daftar ulang atau tes tahap selanjutnya akan kami hubungi melalui nomor WhatsApp yang terdaftar.</p>
            @else
                <p>Mohon maaf, berkas ananda belum dapat kami terima karena tidak memenuhi kualifikasi atau kuota pendaftaran telah penuh. Jangan berkecil hati dan tetap semangat.</p>
            @endif
            
            <p>Terima kasih atas partisipasi Anda.</p>
            <p>Wassalamu'alaikum Warahmatullahi Wabarakatuh.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Panitia PPDB Pesantren Darussalam. Sistem Dikelola oleh lagingoding.com</p>
        </div>
    </div>
</body>
</html>