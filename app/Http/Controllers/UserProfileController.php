<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{
    public function show()
    {
        return view('pages.user-profile');
    }

    public function update(Request $request)
    {
        // dd($request);
        $attributes = $request->validate([
            'email' => ['required', 'max:255',  Rule::unique('users')->ignore(auth()->user()->id)],
        ]);
        $user = auth()->user();
        // dd($user);
       
        $user->update($request->all());
        return back()->with('succes', 'Profile succesfully updated');
    }
}
