<?php

namespace Database\Seeders;

use App\Models\Agenda;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Agenda::create([
            'nama_kegiatan' => 'Acara Kelulusan',
            'tempat' => 'SMK Fatahillah Cileungsi',
            'tanggal' => '2024-06-21',
        ]);
    }
}
