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
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ResponseTraits;

    public function register(RegisterRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'role' => 0,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $token = $user->createToken('token')->accessToken;
            return response()->json(['status' => true, 'token' => $token, 'role' => $user->role]);
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
                return response()->json(['status' => true, 'token' => $token, 'role' => Auth::user()->role]);
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

    public function all()
    {
        try {
            $user = User::where('id', '!=', Auth::id())->get();
            return response()->json($user);
        } catch (Exception $error) {
            return $this->responseError($error->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = User::find($id);
            $data->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $name = time() . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/', $name);
                if ($data->img !== null) {
                    if (file_exists(public_path($data->img))) {
                        unlink($data->img);
                    }
                }
                $data->img = 'uploads/' . $name;
                $data->update();
            }
            return response()->json(['status' => true, 'data' => $data]);
        } catch (Exception $error) {
            return $this->responseError($error->getMessage());
        }
    }
}
