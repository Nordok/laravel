<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class UserController extends Controller
{

    /**
     * @throws ValidationException
     */
    public function login(Request $request) {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', '=', $request->email)->first();


        if(! $user || Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $user->createToken($request->email)->plainTextToken;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function logOut(Request $request) {

        return User::where('email', '=', $request->email)
            ->first()
            ->tokens()
            ->delete();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function register(Request $request) {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::firstOrCreate([
            'name' => $request->name,
            'email' => $request->name,
            'password' => $request->password,
        ]);

        return $user;
    }

    public function getUserProfile($id) {
        $user = User::findOrFail($id);
        return $user;
    }

    public function getUserPosts($id) {
        $userPosts = User::find($id)->posts;
        return $userPosts;
    }
}
