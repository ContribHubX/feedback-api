<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/reset-password', function () {
  return view('auth.reset-password');
})->name('password.reset');


Route::get('/verify-email-page', function (Request $request) {
  $token = $request->query('token');

  return view('verify-email-page', ['token' => $token]);
});
