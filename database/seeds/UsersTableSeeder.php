<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
            'name' => 'zandy ferdiansyah',
            'email' => 'zandyferdi@gmail.com',
            'password' => Hash::make('undira123'),
        ]);

        // Tambahkan data pengguna lainnya di sini jika diperlukan

    }
}
