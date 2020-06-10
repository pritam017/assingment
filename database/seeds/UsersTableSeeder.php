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
            'name' => 'Admin',
            'username' => 'Mr.Admin',
            'role_id' => '1',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin@gmail.com'),
        ]);
        DB::table('users')->insert([
            'name' => 'Customer',
            'username' => 'Mr.Customer',
            'role_id' => '2',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('customer@gmail.com'),
        ]);
    
    }
}
