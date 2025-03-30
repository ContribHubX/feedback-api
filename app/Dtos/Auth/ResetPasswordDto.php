<?php

namespace App\Dtos\Auth;

use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\SendResetLinkRequest;

readonly class ResetPasswordDto
{
  public function __construct(
    public string $email,
    public ?string $token,
    public ?string $new_password,
    public ?string $password_confirmation
  )
  { }

  public static function fromSendResetLinkRequest(SendResetLinkRequest $request): self
  {
    return new self(
      email:  $request->validated("email"),
      token: null,
      new_password: null,
      password_confirmation: null
    );
  }

  public static function fromResetPasswordRequest(ResetPasswordRequest $request): self
  {
    return new self(
      email:  $request->validated("email"),
      token: $request->validated("token"),
      new_password: $request->validated("password"),
      password_confirmation: $request->validated("password_confirmation"),
    );
  }
}
