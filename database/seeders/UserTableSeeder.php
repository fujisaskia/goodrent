<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // name gambar dummy yang digunakan
        $dummyImage = 'Dummy.png';

        // Create the users
        $user1 = User::create([
            'name' => 'SuperAdmin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('admin12345'),
            'no_telp' => '081234567890',
            'image' => $dummyImage,
            'status' => 'Offline',
            'status_pelanggan' => 'Aktif',
        ]);

        $user2 = User::create([
            'name' => 'Hilal Ahamd Mujaddid',
            'email' => 'lalxmilo0607@gmail.com',
            'password' => bcrypt('Fujisaskia07'),
            'no_telp' => '0895404500602',
            'image' => $dummyImage,
            'status' => 'Offline',
            'status_pelanggan' => 'Aktif',
        ]);

        $user3 = User::create([
            'name' => 'Fuji Saskia',
            'email' => 'fujisaskia12@gmail.com',
            'password' => bcrypt('12345678'),
            'no_telp' => '081280164209',
            'image' => $dummyImage,
            'status' => 'Offline',
            'status_pelanggan' => 'Aktif',
        ]);

        $user4 = User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'no_telp' => '-',
            'image' => $dummyImage,
            'status' => 'Offline',
            'status_pelanggan' => 'Aktif',
        ]);

        // Retrieve the roles
        $superadminRole = Role::whereName('superadmin')->first();
        $adminRole = Role::whereName('admin')->first(); // Ambil role admin

        // Assign roles
        $user1->assignRole($superadminRole->name);
        $user2->assignRole($superadminRole->name);
        $user3->assignRole($superadminRole->name);
        $user4->assignRole($adminRole->name); // Assign role admin ke user4

        // Optional: Assign permissions to the superadmin role
        $permissions = Permission::all();
        $superadminRole->syncPermissions($permissions);
    }
}
