<?php

namespace App\Http\Controllers\Users;

use App\Actions\Users\ChangePassword;
use App\Actions\Users\UpdateUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\ChangePasswordRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Http\Resources\Users\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show(): UserResource
    {
        return new UserResource(Auth::user());
    }

    public function update(UpdateUserRequest $request, UpdateUser $updateUser): JsonResponse
    {
        $updateUser(
            user: $request->user(),
            name: $request->input('name'),
            username: $request->input('username'),
            email: $request->input('email'),
            phone: $request->input('phone'),
            // FIX: Use file() to get the uploaded image object
            avatar: $request->file('avatar'),
        );
        return response()->json([
            'status' => true,
            'message' => 'Profile updated successfully',
            'user' => new UserResource(Auth::user()->fresh()),
        ]);
    }

    public function changePassword(ChangePasswordRequest $request, ChangePassword $changePassword): JsonResponse
    {
        $changePassword(
            user: $request->user(),
            password: $request->input('password')
        );

        return response()->json([
            'status' => 'password-changed',
        ]);
    }
}
