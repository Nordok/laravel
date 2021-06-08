<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class UserController extends Controller
{

    /**
     * @param Request $request
     * @return array
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

        $token = $user->createToken($request->email)->plainTextToken;

        return [
            'token' => $token,
            'user' => $user
        ];
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
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::firstOrCreate([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        $token = $user->createToken($request->email)->plainTextToken;

        return [
            'token' => $token,
            'user' => $user
        ];
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getUserProfile($id) {
        return User::findOrFail($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getUserPosts($id) {
        return User::find($id)->posts;
    }


    /**
     * @param User $user
     */
    public function destroy (User $user) {
        $user->delete();
    }
}
