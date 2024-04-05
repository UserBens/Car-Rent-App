<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        
        ], [
            'email.required' => 'email wajib di isi!',
            'password.required' => 'password wajib di isi!',
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($infologin)) {
            return redirect('dashboard');
        } else {
            return redirect('')->withErrors('Email dan Password Tidak Sesuai')->withInput();
        }
    }
}
