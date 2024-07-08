<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use Symfony\Component\HttpFoundation\Response;


class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password),
        ]);

        return new UserResource($user);
    }

    public function login(LoginRequest $request)
    {
        $user = User::where("email", $request->email)->first();
        if (!empty($user)) {
            if (Hash::check($request->password, $user->password)) {
                $tokenInfo = $user->createToken("nvision-spot-test");
                $token = $tokenInfo->plainTextToken;
                return response()->json([
                    "status" => true,
                    "message" => "Login successful",
                    "token" => $token
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    "status" => false,
                    "message" => "The password you entered is incorrect."
                ], Response::HTTP_UNAUTHORIZED);
            }
        } else {
            return response()->json([
                "status" => false,
                "message" => "Invalid login credentials"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function logout()
    {
        request()->user()->tokens()->delete();
        return response()->json([
            "status" => true,
            "message" => "User logged out"
        ]);
    }
}
