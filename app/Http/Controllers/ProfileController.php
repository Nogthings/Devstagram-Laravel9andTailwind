<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index(Request $request)
    {
        return view('profile.index');
    }

    public function store(Request $request)
    {
        $request->request->add(['username' => Str::slug($request->username)]);
        
        $this->validate($request, [
            'username' => ['required', 'unique:users,username,'.auth()->user()->id, 'min:3', 'max:18', 'not_in:edit-profile,twitter']
        ]);

        if($request->image){
            $image = $request->file('image');

            $nameImage = Str::uuid() . "." . $image->extension();
            $serverImage = Image::make($image);
            $serverImage->fit(1000,1000);
            $imagePath = public_path('profiles') . '/' . $nameImage;
            $serverImage->save($imagePath);
        }
        $user = User::find(auth()->user()->id);
        $user->username = $request->username;
        $user->image = $nameImage ?? auth()->user()->image ?? null;
        $user->save();

        return redirect()->route('posts.index', $user->username);
    }
}
