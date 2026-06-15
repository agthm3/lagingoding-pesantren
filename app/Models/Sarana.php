<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sarana extends Model
{
    use HasFactory;

    protected $table = 'saranas';
    
    protected $fillable = [
        'nama_sarana',
        'kategori',
        'foto',
        'deskripsi',
    ];
}