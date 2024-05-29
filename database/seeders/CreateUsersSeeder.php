<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'DefaultAdmin',
                'password' => Hash::make('12345678'),
                'userlevel' => 'Admin',
                'quotes' => 'This is the default account for admin. This account cannot be deleted or renamed.',
            ],
            [
                'name' => 'DefaultGuest',
                'password' => Hash::make('12345678'),
                'userlevel' => 'Guest',
                'quotes' => 'Kamu Bisa Menambahkan Seputar Tentang Dirimu Disini!',
            ],

        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
