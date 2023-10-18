<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // automatically generate admins using database seeder

        // admin number is aligned with their ID
        $lastID = DB::table('users')->max('id');
        $currentID = $lastID + 1;

        // inserts created admins to database
        DB::table('users')->insert([
            'name' => 'Admin'.' '.$currentID,
            'email' => 'admin'.$currentID.'@gmail.com',
            'username' => 'admin'.$currentID,
            'password' => Hash::make('password')
        ]);
    }
}
