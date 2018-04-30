<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mytime = Carbon\Carbon::now();
        DB::table('users')->insert([
            'nama' => 'admin',
            'no_ktp' =>'admin',
            'alamat' => 'bmt',
            'tipe' =>'admin',
            'tanggal_registrasi'=>$mytime,
            'password' => bcrypt('admin'),
        ]);
        DB::table('users')->insert([
            'nama' => 'user',
            'no_ktp' =>'user',
            'alamat' => 'bmt',
            'tipe' =>'anggota',
            'tanggal_registrasi'=>$mytime,
            'password' => bcrypt('user'),
        ]);
        //
    }
}
