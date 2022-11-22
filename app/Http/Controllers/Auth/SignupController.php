<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
    //
    public function index() {
        return view('auth.signup');
    }

     public function store(Request $request)
    {
        // dd($request);
        // dd($request->get('username'));
        $request->request->add(['username' => Str::slug($request->username)]);
        //validacion
        $this->validate($request,[
            'name' => 'required|max:50',
            'username' => 'required|unique:users|min:3|max:18',
            'email' => 'required|unique:users|email|max:50',
            'password' => 'required|confirmed|min:8'
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password) 
        ]);

        //auth
        // auth()->attempt([
        //     'email'=> $request->email,
        //     'password' => $request->password
        // ]);

        //auth
        auth()->attempt($request->only('email', 'password'));

        //redirect
        return redirect()->route('posts.index', auth()->user()->username);

    }
}
