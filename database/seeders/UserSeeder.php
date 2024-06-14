<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name'=>'test1', 
            'email'=>'sample@sample.com',
             'password'=>Hash::make('aassdd111'),
             'created_at'=>'2021/01/01 11:11:11'
        ]);
    }
}
