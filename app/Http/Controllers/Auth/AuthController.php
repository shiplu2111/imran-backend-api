<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Users\CreateUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Users\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register(RegisterRequest $request, CreateUser $createUser): JsonResponse
    {
        $user = $createUser(
            name: $request->input('name'),
            email: $request->input('email'),
            username: $request->input('username'),
            password: $request->input('password'),
        );

        return response()->json([
            'status' => true,
            'message' => 'Successfully registered',
            'user' => new UserResource($user),
        ]);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = [
            filter_var($request->email_or_username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username' => $request->email_or_username,
            'password' => $request->password,
        ];

        $token = Auth::attempt($credentials);

        if (! $token) {
            return response()->json([
                'status' => 'invalid-credentials',
            ], 200);
        }

        return response()->json([
            'status'       => true,
            'user'         => new UserResource(Auth::user()),
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'expires_in'   => Auth::factory()->getTTL() * 60,
            'message'      => 'Successfully logged in',

        ]);
    }

    public function logout(): Response
    {
        Auth::logout();

        return response()->json([
            'status' => true,
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh(): JsonResponse
    {
        $token = Auth::refresh();

        return response()->json([
            'access_token' => $token,
        ]);
    }
}
