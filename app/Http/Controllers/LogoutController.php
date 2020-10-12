<?php

namespace App\Http\Controllers;

use Auth;

class LogoutController extends Controller
{
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
