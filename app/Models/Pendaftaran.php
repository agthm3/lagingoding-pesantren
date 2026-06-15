<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_registrasi', 'nama_santri', 'jenis_kelamin', 'asal_daerah',
        'jenjang', 'nama_wali', 'kontak_wali', 'berkas_kk', 'berkas_akta', 'status'
    ];
}