<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\VerifyEmailRequest;
use App\Services\EmailService;
use Illuminate\Http\Request;

  class EmailController extends Controller
  {
      protected $emailService;

      public function __construct(EmailService $emailService)
      {
        $this->emailService = $emailService;
      }

      public function sendVerificationLink(Request $request)
      {
        $request->validate([
          'email' => 'required|string',
        ]);

        $this->emailService->sendEmailVerificationLink(
          $request->email
        );

        return response()->json(["message" => "Verication link successfully sent"]);
      }

      public function verifyEmail(VerifyEmailRequest $request)
      {
        $result = $this->emailService->verifyUserEmail(
          $request->validated("token")
        );

        return response()->json($result
          ? ["message" => $result]
          : ["message" => "Verification failed"]);
      }
  }
