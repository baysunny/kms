<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class AuthController extends Controller
{
    
    public function vlogin(){
        return view('users.login');
    }

    public function login(Request $request){
        $formFields = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        
        if(auth()->attempt($formFields)){
            $request->session()->regenerate();
            return redirect('/dashboard/patients')->with('message', 'You are logged in');
        }

        return back()->withErrors(['username'=>'Invalid Credentials'])->onlyInput('username');
    }

    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message', 'You have been logged out!');
    }
}
