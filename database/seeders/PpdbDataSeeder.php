<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pendaftaran;

class PpdbDataSeeder extends Seeder
{
    public function run(): void
    {
        Pendaftaran::create([
            'no_registrasi' => 'PPDB-0142',
            'nama_santri' => 'Ahmad Baihaqi',
            'jenis_kelamin' => 'Laki-laki',
            'asal_daerah' => 'Makassar',
            'jenjang' => 'MA',
            'nama_wali' => 'Drs. Syarifuddin',
            'kontak_wali' => '08123456789',
            'berkas_kk' => 'sample_kk.pdf',
            'berkas_akta' => 'sample_akta.pdf',
            'status' => 'Review'
        ]);

        Pendaftaran::create([
            'no_registrasi' => 'PPDB-0141',
            'nama_santri' => 'Siti Aminah',
            'jenis_kelamin' => 'Perempuan',
            'asal_daerah' => 'Gowa',
            'jenjang' => 'MTs',
            'nama_wali' => 'Hj. Maryam',
            'kontak_wali' => '08129876543',
            'berkas_kk' => 'sample_kk.pdf',
            'berkas_akta' => 'sample_akta.pdf',
            'status' => 'Lolos'
        ]);

        Pendaftaran::create([
            'no_registrasi' => 'PPDB-0140',
            'nama_santri' => 'Zainal Abidin',
            'jenis_kelamin' => 'Laki-laki',
            'asal_daerah' => 'Maros',
            'jenjang' => 'Tahfidz',
            'nama_wali' => 'Ustadz Usman',
            'kontak_wali' => '08521122334',
            'berkas_kk' => 'sample_kk.pdf',
            'berkas_akta' => 'sample_akta.pdf',
            'status' => 'Ditolak'
        ]);
    }
}