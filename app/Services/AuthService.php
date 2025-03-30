<?php

namespace App\Services;

use App\Dtos\Auth\AuthenticationDto;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    /**
     * Register a new user.
     */
    public function registerUser(AuthenticationDto $dto)
    {
        if (User::where("email", $dto->email)->exists()) {
            throw ValidationException::withMessages([
                "email" => ["This email is already taken"]
            ]);
        }

        $user = User::create([
            "name" => $dto->name,
            "email" => $dto->email,
            "password" => Hash::make($dto->password)
        ]);

        return [
            "user" => $user,
            "token" => $user->createToken("auth_token")->plainTextToken
        ];
    }

    /**
     * Authenticate a user and generate an access token.
     */
    public function loginUser(AuthenticationDto $dto)
    {
        $user = User::where("email", $dto->email)->first();

        if (!$user || !Hash::check($dto->password, $user->password)) {
            throw ValidationException::withMessages([
                "email" => ["Invalid login credentials"]
            ]);
        }

        return [
            "user" => $user,
            "token" => $user->createToken("auth_token")->plainTextToken
        ];
    }
}
