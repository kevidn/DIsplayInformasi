<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/dashboard';

    // Method untuk mengatur kredensial yang digunakan untuk login
    public function username()
    {
        return 'name'; // Gunakan 'name' sebagai kredensial
    }

    // Method untuk menangani proses login
    public function login(Request $request): RedirectResponse
    {   
        $input = $request->all();
     
        $this->validate($request, [
            'name' => 'required|string', // Menggunakan 'name' sebagai kredensial
            'password' => 'required',
        ]);
     
        if(auth()->attempt(array('name' => $input['name'], 'password' => $input['password'])))
        {
            return redirect()->intended('/dashboard'); // Menggunakan 'intended' untuk mengarahkan pengguna ke lokasi yang seharusnya setelah login berhasil
        } else {
            return redirect()->route('login')
                ->with('error','Name or Password is Invalid.'); // Mengubah pesan error
        }
    }
    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
      }
}