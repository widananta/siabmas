<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Ringgi',
            'nip' => '223456789012345678',
            'tgl_lahir' => '1997-11-06',
            'jenis_kelamin' => 'l',
            'no_telp' => '081234567812',
            'alamat' => 'Jetis Kulon',
            'role' => 'root_user',
            'email' => 'root@user.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
