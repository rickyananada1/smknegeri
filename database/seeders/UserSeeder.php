<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = array(
            [
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password' => Hash::make('123456789'),
                'phone' => '081362',
                'role' => 'a',
            ],[
                'name' => 'Guru',
                'email' => 'guru@gmail.com',
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password' => Hash::make('123456789'),
                'phone' => '081361',
                'role' => 'g',
            ],[
                'name' => 'Siswa',
                'email' => 'siswa@gmail.com',
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password' => Hash::make('123456789'),
                'phone' => '081363',
                'role' => 's',
            ]
        );
        foreach($data AS $d){
            User::create([
                'name' => $d['name'],
                'email' => $d['email'],
                'email_verified_at' => $d['email_verified_at'],
                'phone' => $d['phone'],
                'password' => $d['password'],
                'role' => $d['role']
            ]);
        }
    }
}
