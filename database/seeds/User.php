<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class User extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
       $users =[[
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
           'role_id' => 1
        ],
        [
           'name' => 'Viewer',
           'email' =>'viewer@gmail.com',
           'password' => Hash::make('12345678'),
           'role_id' => 2
       ]];
        DB::table('users')->insert($users);

    }
}
