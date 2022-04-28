<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Hash;
use Auth;

class RegisterController extends Controller
{
    public function index () {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password')); // bcrypt
        
        $userRole = Role::where('slug', '=', 'user')->first();
        $user->role()->associate($userRole);

        $user->save();

        Auth::login($user);
        //add in profile index later
        return redirect()->route('profile.index');
    }
}
