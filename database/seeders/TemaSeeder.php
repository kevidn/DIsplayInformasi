<?php

namespace Database\Seeders;

use App\Models\Agenda;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tema::create([
            'bg' => '/images/bg-blue.jpg',
            'color' => '#00324946',
        ]);
    }
}
