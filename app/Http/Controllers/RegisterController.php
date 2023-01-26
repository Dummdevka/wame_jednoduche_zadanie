<?php

namespace App\Http\Controllers;

// use App\Http\Requests\RegisterRequest;

use App\Mail\ConfirmRegister;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:5|max:255',
            'terms' => 'required'
        ]);
        $user = User::create($attributes);
        $token = Hash::make($user->email);
        $link = env('APP_URL') . '/confirm/email?id=' . $user->id . '&token=' . urlencode($token);
        Mail::to($user->email)->send(new ConfirmRegister($link)); 

        return redirect('registration/success');
    }

    public function confirm_email(Request $request) {
        $user = User::findOrFail($request->id);

        if(Hash::check($user->email, $request->token) && !$user->email_verified_at) {
            $user->email_verified_at = Carbon::now();
            auth()->login($user);
            return redirect('/dashboard');
        }
        return redirect('/'); 
    }
}
