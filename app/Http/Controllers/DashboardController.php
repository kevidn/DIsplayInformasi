<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Services\Cuaca;
use App\Services\Jam;
use App\Models\Berita;
use App\Models\Header;

use Illuminate\Http\Request;







class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $user = Auth::user();
        $userName = $user ? $user->name : ''; // Handle potential null user

        return view('dashboard.index', compact('user'));
    }

    public function berita(Request $request)
    {
        return view('dashboard.berita');
    }
    public function agenda(Request $request)
    {
        return view('dashboard.agenda');
        
    }
    public function akun(Request $request)
    {
        return view('dashboard.akun');
    }
    public function runningtext(Request $request)
    {
        return view('dashboard.runningtext');
    }
    public function video(Request $request)
    {
        return view('dashboard.video');
    }
    public function tambahagenda(Request $request)
    {
        return view('dashboard.CRUD.tambahagenda');
    }
    public function tambahberita(Request $request)
    {
        return view('dashboard.CRUD.tambahberita');
    }
    public function editagenda(Request $request)
    {
        return view('dashboard.CRUD.editagenda');
    }
    public function editberita(Request $request)
    {
        return view('dashboard.CRUD.editberita');
    }




    // public function buattes(Request $request)
    // {
    //     return view('dashboard.tesaagenda');
        
    // }
    
}
