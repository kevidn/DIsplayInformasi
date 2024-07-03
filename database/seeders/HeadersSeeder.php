<?php

namespace Database\Seeders;


use App\Models\Header;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeadersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Header::create([
            'logo1' => '1719996578_defaultakun.jpeg',
            'logo2' => '1719996578_defaultakun.jpeg',
            'nama_sekolah' =>'SEKOLAH INDONESIA',
            'sambutan' => 'SELAMAT DATANG DI SEKOLAH KAMI'
        ]);
    }
}
