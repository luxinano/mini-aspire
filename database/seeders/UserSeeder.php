<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'user1',
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('123'),
                'approver' => false
            ], [
                'name' => 'user2',
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('123'),
                'approver' => false
            ], [
                'name' => 'approver1',
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('123'),
                'approver' => true
            ], [
                'name' => 'approver2',
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('123'),
                'approver' => true
            ]
        ];
        DB::table('user')->insert($users);
    }
}
