<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class RoleAndUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Bersihkan cache Spatie (Wajib jika sering melakukan reset database)
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. Buat Role Sistem (Hanya nama role saja)
        $roleSuperadmin = Role::create(['name' => 'superadmin']);
        $roleAdmin      = Role::create(['name' => 'admin']);
        $roleBendahara  = Role::create(['name' => 'bendahara']);

        // 3. Buat Akun User & Sematkan Role-nya

        // User 1: Superadmin Utama (Pemilik Sistem)
        $user1 = User::create([
            'name'      => 'Fadehl Thristansyah',
            'email'     => 'fadehl@lagingoding.com',
            'password'  => Hash::make('PesantrenCore2026'),
            'is_active' => true,
        ]);
        $user1->assignRole($roleSuperadmin); // Berikan hak akses tertinggi

        // User 2: Administrator Standar (Pengelola Konten)
        $user2 = User::create([
            'name'      => 'Andi Gigatera',
            'email'     => 'andigigatera@gmail.com',
            'password'  => Hash::make('PesantrenCore2026'),
            'is_active' => true,
        ]);
        $user2->assignRole($roleAdmin);

        // User 3: Bendahara (Akses Modul Keuangan Saja)
        $user3 = User::create([
            'name'      => 'Ustadzah Nisa',
            'email'     => 'nisa.bendahara@pesantren.sch.id',
            'password'  => Hash::make('PesantrenCore2026'),
            'is_active' => true,
        ]);
        $user3->assignRole($roleBendahara);

        $this->command->info('Data Role Spatie dan 3 User Awal Berhasil Dibuat!');
    }
}