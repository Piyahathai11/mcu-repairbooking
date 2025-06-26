<?php

namespace Database\Seeders;

use App\Enums\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username'   => 'test1',
            'fullName'   => 'test1',
            'phone'      => '0123456789',
            'email'      => 'test1@example.com',
            'password'   => Hash::make('12345'), // 🔒 Securely hashed password
            'position'   => 'เจ้าหน้าที่จัดการงานทั่วไป',
            'personnel'  => 'ภายใน',
            'role'       => Role::USER,
            

        ]);
    }
}
