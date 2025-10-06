<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create() 
    {
        return view('auth/login');
    }

    public function store()
    {
        // validate
        $validatedAttributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        // attempt to login
        Auth::attempt($validatedAttributes);

        if (! Auth::attempt($validatedAttributes)) {
            throw ValidationException::withMessages([
                'email' => 'No user with that email addresss',
                'password' => 'Incorrect Password'
            ]);
        }

        // regenerate session token
        request()->session()->regenerate();

        //redirect
        return redirect('/jobs');
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/');
    }
}
