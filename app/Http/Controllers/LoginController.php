<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    function login(Request $request) {
        $credentials = $request->only(['email', 'password']);
        $credentials['is_active'] = 1;
        if(!Auth::attempt($credentials)) {
            $request->session()->put('error', 'Information is not true');
        }

        return redirect()->route('index');
    }

    function logout() {
        Auth::logout();
        return redirect()->route('index');
    }
}