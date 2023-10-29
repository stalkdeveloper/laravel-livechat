<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'email'   =>'admin@stalkdeveloper.com',
            'name'    =>'Admin',
            'usertype' =>'admin',
            'password'=>Hash::make('Admin@1234') // <---- check this
        ]);

        DB::table('users')->insert([
            'email'   =>'user1@stalkdeveloper.com',
            'name'    =>'User1',
            'usertype' =>'user',
            'password'=>Hash::make('User@1234') // <---- check this
        ]);

        DB::table('users')->insert([
            'email'   =>'user2@stalkdeveloper.com',
            'name'    =>'User2',
            'usertype' =>'user',
            'password'=>Hash::make('User@1234') // <---- check this
        ]);
    }
}