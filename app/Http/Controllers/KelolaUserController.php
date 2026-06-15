<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Exception;

class KelolaUserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->latest()->get();
        $roles = Role::all();

        return view("dashboard.kelolaUser.index", compact('users', 'roles'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Input dengan Pesan Kustom
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|exists:roles,name',
        ], [
            'email.unique' => 'Alamat email ini sudah terdaftar di sistem.',
            'password.min' => 'Kata sandi harus minimal 6 karakter.',
            'role.required' => 'Peran otoritas wajib dipilih.'
        ]);

        try {
            // 2. Simpan User Baru
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_active' => true,
            ]);

            // 3. Pasang Role menggunakan Spatie
            $user->assignRole($request->role);

            return redirect()->route('dashboard.kelolaUser.index')
                             ->with('success', 'Pengguna baru dan hak akses berhasil didaftarkan!');
                             
        } catch (Exception $e) {
            // Tangkap error sistem agar tidak crash
            return back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            
            // Proteksi: Superadmin tidak boleh menghapus dirinya sendiri
            if ($user->id === auth()->id()) {
                return back()->with('error', 'Akses ditolak! Anda tidak dapat menghapus akun yang sedang Anda gunakan.');
            }

            $user->delete();
            return back()->with('success', 'Akun pengguna berhasil dihapus secara permanen.');
            
        } catch (Exception $e) {
            return back()->with('error', 'Gagal menghapus pengguna: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // 1. Validasi Input Edit
        $request->validate([
            'name' => 'required|string|max:255',
            // Pengecualian unique email untuk user yang sedang diedit
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            // Password bersifat nullable (opsional saat edit)
            'password' => 'nullable|string|min:6', 
            'role' => 'required|exists:roles,name',
        ], [
            'email.unique' => 'Alamat email ini sudah terdaftar di sistem.',
            'password.min' => 'Kata sandi minimal 6 karakter jika ingin diubah.',
            'role.required' => 'Peran otoritas wajib dipilih.'
        ]);

        try {
            // 2. Update Data User
            $user->name = $request->name;
            $user->email = $request->email;
            
            // Jika kolom password diisi, maka update passwordnya
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            
            $user->save();

            // 3. Sinkronisasi Role (Hapus role lama, pasang role baru)
            $user->syncRoles([$request->role]);

            return redirect()->route('dashboard.kelolaUser.index')
                             ->with('success', 'Data dan otoritas pengguna berhasil diperbarui!');
                             
        } catch (Exception $e) {
            return back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage())->withInput();
        }
    }
}