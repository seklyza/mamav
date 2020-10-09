<?php

namespace App\Http\Controllers;

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
        /** @var string */ $name = $data['name'];
        /** @var string */ $email = $data['email'];
        /** @var string */ $username = $data['username'];
        /** @var string */ $password = $data['password'];
        /** @var string */ $passwordConfirmation = $data['password_confirmation'];

        return $this->index();
    }
}
