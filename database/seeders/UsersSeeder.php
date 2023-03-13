<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
            array(
                'name'          => 'Sigit Boworaharjo',
                'email'         => 'kangteknisi@gmail.com',
                'password'      => bcrypt('qwerty'),
                'role_id'       => 1,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
        );
        DB::table('users')->insert($data);

        $data = array(
            array(
                'name'          => 'Arya nada',
                'email'         => 'aryanada@gmail.com',
                'password'      => bcrypt('qwerty'),
                'kelas_id'      => 45,
                'NISN'          => '00477584',
                'role_id'       => 3,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
        );
        DB::table('users')->insert($data);
    }
}
