<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f1f5f9; padding: 20px; color: #334155; }
        .container { max-w-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border-radius: 8px; border-left: 4px solid #4f46e5; }
        h3 { color: #312e81; margin-top: 0;}
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 10px; border-bottom: 1px solid #e2e8f0; text-align: left; font-size: 14px; }
        th { width: 35%; color: #64748b; }
        .btn { display: inline-block; padding: 10px 20px; background-color: #4f46e5; color: #ffffff; text-decoration: none; border-radius: 5px; margin-top: 20px; font-weight: bold; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <h3>Pemberitahuan Pendaftar Baru Masuk</h3>
        <p>Sistem baru saja merekam masuknya berkas pendaftaran calon santri baru. Berikut adalah rincian datanya:</p>
        
        <table>
            <tr><th>No. Registrasi</th><td><strong>{{ $no_registrasi }}</strong></td></tr>
            <tr><th>Nama Calon Santri</th><td>{{ $nama_santri }}</td></tr>
            <tr><th>Pilihan Jenjang</th><td>{{ $jenjang }}</td></tr>
            <tr><th>Nama Wali</th><td>{{ $nama_wali }}</td></tr>
            <tr><th>Kontak Wali (WA)</th><td>{{ $kontak_wali }}</td></tr>
        </table>
        
        <p>Silakan segera login ke dashboard Administrator untuk melakukan review berkas KK dan Akta Kelahiran pendaftar bersangkutan.</p>
    </div>
</body>
</html>