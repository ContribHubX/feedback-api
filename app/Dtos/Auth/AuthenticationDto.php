<?php

 namespace App\Dtos\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;

 readonly class AuthenticationDto
 {
   public function __construct(
     public ?string $name = null,
     public string $email,
     public string $password
   )
   { }

   public static function fromRegisterRequest(RegisterRequest $request): self
   {
     return new self(
       email:  $request->validated("email"),
       name: $request->validated("name"),
       password: $request->validated("password")
     );
   }

   public static function fromLoginRequest(LoginRequest $request): self
   {
     return new self(
       name: null,
       email:  $request->validated("email"),
       password: $request->validated("password")
     );
   }
 }
