<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tema;

class TemaController extends Controller
{
    public function updateTema(Request $request)
    {
        $validatedData = $request->validate([
            'theme_choice' => 'required|in:blue,green',
        ]);

        $theme = $request->input('theme_choice');

        // Data untuk tema
        $temaOptions = [
            'blue' => [
                'bg' => '/images/bg-blue.jpg',
                'color' => '#00324946'
            ],
            'green' => [
                'bg' => '/images/bg-green.jpg',
                'color' => '#00491646'
            ]
        ];

        // Ambil data tema pertama jika ada
        $tema = Tema::first();

        if ($tema) {
            // Update tema jika sudah ada
            $tema->bg = $temaOptions[$theme]['bg'];
            $tema->color = $temaOptions[$theme]['color'];
            $tema->save();
        } else {
            // Buat data tema baru jika belum ada
            Tema::create([
                'bg' => $temaOptions[$theme]['bg'],
                'color' => $temaOptions[$theme]['color'],
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Tema berhasil diperbarui.');
    }
}
