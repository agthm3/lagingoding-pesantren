<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilSetting extends Model
{
    use HasFactory;

    protected $table = 'profil_settings';
    
    protected $fillable = ['key', 'value'];
}