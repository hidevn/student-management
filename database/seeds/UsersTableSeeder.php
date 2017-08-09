<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'Giáo viên 1',
            'username' => 'teacher1',
            'email' => 'teacher1@teacher.com',
            'phone_number' => '0969696969',
            'password' => bcrypt('teacher1'),
            'is_admin' => true
        ]);
    }
}
