<?php

namespace App\Http\Controllers;

use App\Models\ProfilSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Exception;

class ProfilKontenController extends Controller
{
    public function index()
    {
        $settings = ProfilSetting::pluck('value', 'key')->all();
        return view('dashboard.profil_konten.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'sambutan_foto'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
            'sambutan_nama'     => 'required|string|max:255',
            'sambutan_jabatan'  => 'required|string|max:255',
            'sambutan_teks'     => 'required|string',
            'sejarah_teks'      => 'required|string',
            'sejarah_foto'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
            'visi_teks'         => 'required|string',
            'visi_misi_teks'    => 'required|string',
            'struktur_pengurus' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
            
            // VALIDASI KONTEN PENDIDIKAN & AGENDA
            'pendidikan_mts'     => 'required|string',
            'pendidikan_ma'      => 'required|string',
            'pendidikan_tahfidz' => 'required|string',
            'file_brosur'        => 'nullable|mimes:pdf|max:4096',
            'agenda_1_waktu' => 'required|string', 'agenda_1_judul' => 'required|string', 'agenda_1_teks' => 'required|string',
            'agenda_2_waktu' => 'required|string', 'agenda_2_judul' => 'required|string', 'agenda_2_teks' => 'required|string',
            'agenda_3_waktu' => 'required|string', 'agenda_3_judul' => 'required|string', 'agenda_3_teks' => 'required|string',
            'agenda_4_waktu' => 'required|string', 'agenda_4_judul' => 'required|string', 'agenda_4_teks' => 'required|string',
        ]);

        try {
            // 1. UPLOAD MEDIA GAMBAR & FILE PDF BROSUR
            $fileFields = ['sambutan_foto', 'sejarah_foto', 'struktur_pengurus'];
            foreach ($fileFields as $field) {
                if ($request->hasFile($field)) {
                    $old = ProfilSetting::where('key', $field)->first();
                    if ($old && $old->value) { Storage::disk('public')->delete($old->value); }
                    $path = $request->file($field)->store('profil', 'public');
                    ProfilSetting::updateOrCreate(['key' => $field], ['value' => $path]);
                }
            }

            if ($request->hasFile('file_brosur')) {
                $oldBrosur = ProfilSetting::where('key', 'file_brosur')->first();
                if ($oldBrosur && $oldBrosur->value) { Storage::disk('public')->delete($oldBrosur->value); }
                $pathBrosur = $request->file('file_brosur')->store('dokumen', 'public');
                ProfilSetting::updateOrCreate(['key' => 'file_brosur'], ['value' => $pathBrosur]);
            }

            // 2. AMANKAN SELURUH DATA TEKS KE DATABASE (Looping otomatis)
            $textInputs = $request->except(['_token', '_method', 'sambutan_foto', 'sejarah_foto', 'struktur_pengurus', 'file_brosur']);
            foreach ($textInputs as $key => $value) {
                ProfilSetting::updateOrCreate(['key' => $key], ['value' => $value]);
            }

            return redirect()->route('dashboard.profil-konten.index')->with('success', 'Seluruh komponen wujud profil, program studi, dan berkas kurikulum diperbarui permanen.');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal mengamankan data konten: ' . $e->getMessage())->withInput();
        }
    }
}