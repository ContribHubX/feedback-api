<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email</title>
</head>
<body>
    <h2>Hello, {{ $name }}</h2>
    <p>Click the button below to verify your email:</p>

    <a href="{{ $verificationLink }}" style="
        display: inline-block;
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        font-size: 16px;
        border-radius: 5px;
        border: none;
        cursor: pointer;">
        Verify Email
    </a>
</body>
</html>
