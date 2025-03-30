<?php

namespace App\Services;

use App\Dtos\Auth\ResetPasswordDto;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class PasswordResetService
{
    /**
     * Send a password reset link to the user.
     */
    public function sendUserResetLink(ResetPasswordDto $dto)
    {
        $user = User::where('email', $dto->email)->first();

        if (!$user) {
            throw new AuthorizationException('User not found.');
        }

        $status = Password::sendResetLink(['email' => $dto->email], function ($user, string $token) {
           // $resetLink = url('/reset-password?token=' . $token . '&email=' . $user->email);
            $resetLink = env('FRONTEND_URL') . '/reset-password?token=' . $token . '&email=' . $user->email;
            Mail::to($user->email)->send(new ResetPasswordMail($user->name, $resetLink));
        });

        return $status;
    }

    /**
     * Reset the user's password.
     */
    public function resetUserPassword(ResetPasswordDto $dto)
    {
        $status = Password::reset(
            ['email' => $dto->email, 'password' => $dto->new_password, 'password_confirmation' => $dto->password_confirmation, 'token' => $dto->token],
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }
        );

        return $status;
    }
}

