<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdatePasswordRequest $request): JsonResponse
    {
        // Validation is already done by UpdatePasswordRequest.
        // If we reach this line, the current_password is correct.
try {
        $request->user()->update([
            'password' => Hash::make($request->validated('password')),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Password updated successfully.',
        ]);
} catch (\Exception $e) {
    return response()->json([
        'status' => false,
        'message' => 'Failed to update password. Please try again later.',
    ], 500);
}
    }
    }

