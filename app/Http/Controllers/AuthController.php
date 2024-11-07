<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('Auth::login');
    }

    public function do_login(Request $request)
    {
        // Validasi input dari pengguna
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:255',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {            
            $errors = $validator->errors();
            if ($errors->has('username')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => 'Masukkan Username Anda',
                ]);
            } elseif ($errors->has('password')) {
                if ($errors->first('password') == 'min') {
                    return response()->json([
                        'alert' => 'error',
                        'message' => 'Password Harus Minimal 8 Karakter',
                    ]);
                }
                return response()->json([
                    'alert' => 'error',
                    'message' => 'Masukkan Password Anda Yang Benar',
                ]);
            } else {
                return response()->json([
                    'alert' => 'error',
                    'message' => 'Harap Perhatikan Sepertinya Ada Yang Salah',
                ]);
            }
        } 

        // Proses autentikasi
        if(Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            // Login berhasil 
            $user = Auth::user();  
            $user->last_update = now();  
            $user->save();  
            
            return response()->json([
                'alert' => 'success',
                'message' => 'Login berhasil!',
                'callback' => url('/admin/dashboard')
            ]);
        } 
        else{
            return response()->json([
                'alert' => 'error',
                'message' => 'Maaf, Username dan Password Salah. Silakan coba lagi.',
            ]);
        } 
    }

    public function logout(Request $request)
    {
        // Hapus sesi login pengguna
        Auth::logout();
        
        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 
        return redirect()->route('login')->with('message', 'Anda telah berhasil logout.');
    }




}