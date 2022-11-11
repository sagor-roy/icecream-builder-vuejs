<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserResponseResource;
use App\Models\User;
use App\Traits\ResponseTraits;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ResponseTraits;

    public function register(RegisterRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $token = $user->createToken('token')->accessToken;
            return response()->json(['token' => $token]);
        } catch (Exception $error) {
            return $this->responseError($error->getMessage());
        }
    }

    /**
     * Login
     */
    public function login(LoginRequest $request)
    {
        try {
            if (Auth::attempt($request->only('email', 'password'))) {
                $token = Auth::user()->createToken('token')->accessToken;
                return response()->json(['token' => $token]);
            }
            return $this->responseError("The credential doesn't match our record");
        } catch (Exception $error) {
            return $this->responseError($error->getMessage());
        }
    }

    public function logout()
    {
        try {
            Auth::user()->token()->revoke();
            return $this->responseSuccess("Logout Successfull");
        } catch (Exception $error) {
            return $this->responseError($error->getMessage());
        }
    }

    public function user()
    {
        try {
            $user = Auth::user();
            return response()->json($user);
        } catch (Exception $error) {
            return $this->responseError($error->getMessage());
        }
    }
}
