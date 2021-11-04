<?php

use Illuminate\Database\Seeder;

class Role extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roles = [['role_name' => 'Admin'],['role_name'=>'Viewer'] ];
        DB::table('roles')->insert($roles);
    }
}
