<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('owners')->insert([
            [
                'name'=>'test1', 
                'email'=>'sample@sample.com',
                'password'=>Hash::make('aassdd111'),
                'created_at'=>'2021/01/01 11:11:11'
            ],
            [
                'name'=>'test2', 
                'email'=>'sample2@sample.com',
                'password'=>Hash::make('aassdd222'),
                'created_at'=>'2021/01/01 11:11:11'
            ],
            [
                'name'=>'test3', 
                'email'=>'sample3@sample.com',
                'password'=>Hash::make('aassdd333'),
                'created_at'=>'2021/01/01 11:11:11'
            ],
            [
                'name'=>'test4', 
                'email'=>'sample4@sample.com',
                'password'=>Hash::make('aassdd333'),
                'created_at'=>'2021/01/01 11:11:11'
            ],
            [
                'name'=>'test5', 
                'email'=>'sample5@sample.com',
                'password'=>Hash::make('aassdd333'),
                'created_at'=>'2021/01/01 11:11:11'
            ],
            [
                'name'=>'test6', 
                'email'=>'sample6@sample.com',
                'password'=>Hash::make('aassdd333'),
                'created_at'=>'2021/01/01 11:11:11'
            ],
        ]);
    }
}
