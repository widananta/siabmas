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
            'name' => 'Ringgi Widananta Fikar',
            'nip' => '111111111111111111',
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
        DB::table('users')->insert([
            'name' => 'Asmunin, S.Kom., M.Kom.',
            'nip' => '197701102008121003',
            'tgl_lahir' => '1977-01-10',
            'jenis_kelamin' => 'l',
            'no_telp' => '085732587200',
            'alamat' => 'Griya Taman Asri DG-1',
            'role' => 'dosen',
            'email' => 'asmunin@yahoo.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'name' => 'Agus Prihanto',
            'nip' => '197908062006041001',
            'tgl_lahir' => '1979-08-06',
            'jenis_kelamin' => 'l',
            'no_telp' => '08563061761',
            'alamat' => 'Ketintang Barat Indah no 22',
            'role' => 'dosen',
            'email' => 'aguspri@user.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
