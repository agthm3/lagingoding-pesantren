<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f8fafc; padding: 20px; color: #334155; }
        .container { max-w-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 30px; border-radius: 8px; border-top: 4px solid #047857; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); }
        .header { text-align: center; border-bottom: 1px solid #e2e8f0; padding-bottom: 20px; margin-bottom: 20px; }
        .title { color: #047857; font-size: 24px; font-weight: bold; margin: 0; }
        .content { line-height: 1.6; }
        .highlight { background-color: #ecfdf5; border: 1px dashed #10b981; padding: 15px; text-align: center; border-radius: 8px; margin: 20px 0; font-size: 20px; font-weight: bold; color: #047857; letter-spacing: 2px;}
        .footer { margin-top: 30px; border-top: 1px solid #e2e8f0; padding-top: 20px; text-align: center; font-size: 12px; color: #94a3b8; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="title">Pesantren Darussalam</h1>
            <p style="margin: 5px 0 0 0; color: #64748b;">Bukti Registrasi Pendaftaran Santri Baru</p>
        </div>
        <div class="content">
            <p>Assalamu'alaikum Warahmatullahi Wabarakatuh,</p>
            <p>Yth. Bapak/Ibu <strong>{{ $nama_wali }}</strong>,</p>
            <p>Alhamdulillah, kami telah menerima berkas pendaftaran calon santri atas nama <strong>{{ $nama_santri }}</strong> untuk jenjang <strong>{{ $jenjang }}</strong>.</p>
            
            <div class="highlight">
                {{ $no_registrasi }}
            </div>
            
            <p>Mohon simpan Nomor Registrasi di atas dengan baik. Berkas Anda saat ini sedang dalam status <strong>Menunggu Review</strong> oleh tim panitia kami. Pengumuman hasil verifikasi akan kami informasikan kembali melalui email ini.</p>
            <p>Jazakumullah Khairan atas kepercayaan Anda kepada lembaga kami.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Panitia PPDB Pesantren Darussalam. Sistem Dikelola oleh lagingoding.com</p>
        </div>
    </div>
</body>
</html>