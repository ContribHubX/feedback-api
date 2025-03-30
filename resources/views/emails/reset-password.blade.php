<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            color: #333;
        }
        p {
            color: #555;
            font-size: 16px;
            line-height: 1.5;
        }
        .button {
            display: inline-block;
            padding: 12px 20px;
            margin: 20px 0;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Password Reset Request</h2>
        <p>Hello <strong>{{ $name }}</strong>,</p>
        <p>We received a request to reset your password. Click the button below to set a new password:</p>
        <p>
            <a href="{{ $resetLink }}" class="button">Reset Password</a>
        </p>
        <p>If you did not request this password reset, please ignore this email. Your password will remain unchanged.</p>
        <p class="footer">Thank you, <br> <strong>Your Application Team</strong></p>
    </div>
</body>
</html>
