<?php

namespace App\Services;

use App\Mail\VerifyEmail;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class EmailService
{
   public function sendEmailVerificationLink(string $email)
   {
      $user = User::where("email", $email)->first();

      if (!$user) {
        throw new AuthorizationException("User doesn't exist");
      }

      if ($user->email_verified_at) {
        throw new BadRequestHttpException("Email is already verified.");
      }

      $verificationToken = Str::random(40);
      $user->update(["verification_token" => $verificationToken]);

      $verificationLink = url("/verify-email-page?token={$verificationToken}");
      Mail::to($user->email)->send(new VerifyEmail($user->name, $verificationLink, $verificationToken));
   }

   public function verifyUserEmail(string $token)
    {
        $user = User::where("verification_token", $token)->first();

        if (!$user) {
            throw new AuthorizationException("Invalid verification token");
        }

        $user->update([
            'email_verified_at' => now(),
            'verification_token' => null,
        ]);

        return "Email verified successfully!";
    }
}
