<?php

namespace App\Http\Controllers;

use App\Dtos\Auth\AuthenticationDto;
use App\Dtos\Auth\ResetPasswordDto;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\SendResetLinkRequest;
use App\Services\AuthService;
use App\Services\PasswordResetService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    protected $authService;
    protected $passwordResetService;

    public function __construct(AuthService $authService, PasswordResetService $passwordResetService)
    {
        $this->authService = $authService;
        $this->passwordResetService = $passwordResetService;
    }

    /**
     * Register a new user.
     */
    public function register(RegisterRequest $request)
    {
        $data = $this->authService->registerUser(
          AuthenticationDto::fromRegisterRequest($request)
        );

        return response()->json([
            "message" => "User registered successfully",
            "user" => $data["user"],
            "token" => $data["token"]
        ], 201);
    }

    /**
     * Authenticate a user and return a token.
     */
    public function login(LoginRequest $request)
    {
        $data = $this->authService->loginUser(
            AuthenticationDto::fromLoginRequest($request)
        );

        return response()->json([
            "message" => "User logged in successfully",
            "user" => $data["user"],
            "token" => $data["token"]
        ], 200);
    }

    /**
     * Get details of the authenticated user.
     */
    public function getMyDetails(Request $request)
    {
        return response()->json($request->user());
    }

    /**
     * Send a password reset link.
     */
    public function sendResetLink(SendResetLinkRequest $request)
    {
        $status = $this->passwordResetService->sendUserResetLink(
            ResetPasswordDto::fromSendResetLinkRequest($request)
        );

        return $status === Password::RESET_LINK_SENT
            ? response()->json(["message" => "Reset link sent successfully"])
            : response()->json(["message" => "Failed to send reset link"], 400);
    }

    /**
     * Reset the user's password.
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        $status = $this->passwordResetService->resetUserPassword(
            ResetPasswordDto::fromResetPasswordRequest($request)
        );

        return $status === Password::PASSWORD_RESET
            ? response()->json(["message" => "Password reset successful."])
            : response()->json(["error" => "Invalid token or email."], 400);
    }

    /**
     * Logout the authenticated user.
     */
    public function logout(Request $request)
    {
        $user = $request->user();

        if ($user) {
            $user->tokens()->delete();

            return response()->json([
                "message" => "User logged out successfully."
            ], 200);
        }

        return response()->json([
            "error" => "No authenticated user found."
        ], 400);
    }
}
