<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return inertia('Register');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'string|required|min:3',
            'email' => 'string|required|email|min:6',
            'username' => 'string|required|min:6',
            'password' => 'string|required|confirmed|min:6',
            'password_confirmation' => 'string|required',
        ]);

        try {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ]);
        } catch (QueryException $ex) {
            if ($ex->errorInfo[0] === "23000") {
                return back()->with(['message' => 'Username/email is already taken.']);
            }
        }

        event(new Registered($user));

        Auth::login($user);

        return inertia('Register', ['success' => 'Please check your email!']);
    }
}
