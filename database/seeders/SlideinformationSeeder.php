<?php

namespace Database\Seeders;


use App\Models\Slideinformation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SlideinformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Slideinformation::create([
            'quotes' => 'Allah tidak membebani seseorang melainkan sesuai dengan kesanggupannya',
            'gambar' => 'aa.jpg',
        ]);
    }
}
