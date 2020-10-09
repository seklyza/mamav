<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function verifyEmail(EmailVerificationRequest $request)
    {
        /** @var \App\Models\User */ $user = $request->user();
        if ($user->email_verified_at) {
            return redirect()->route('login');
        }

        $request->fulfill();

        return redirect()->route('index');
    }
}
