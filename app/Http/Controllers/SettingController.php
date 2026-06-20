<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function email()
    {
        $setting = \App\Models\Setting::first();
        return view('dashboard.settings.email', compact('setting'));
    }

    public function updateEmail(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'admin_email' => 'required|email|max:255'
        ]);

        $setting = \App\Models\Setting::first();
        if (!$setting) {
            $setting = new \App\Models\Setting();
        }

        $setting->admin_email = $request->admin_email;
        $setting->save();

        return redirect()->back()->with('success', 'Email notifikasi admin berhasil diperbarui!');
    }
}
