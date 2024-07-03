<?php

namespace Database\Seeders;

use App\Models\RT;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RTSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RT::create([
            'RT' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
        ]);
    }
}
