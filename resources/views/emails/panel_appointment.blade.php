<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panelist Appointment</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background-color: #005b96;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .email-body {
            padding: 20px;
        }
        .email-body p {
            font-size: 16px;
            line-height: 1.5;
            color: #333;
        }
        .email-body .password {
            font-weight: bold;
            font-size: 16px;
            color: #d94f4f;
        }
        .email-footer {
            background-color: #f7f7f7;
            padding: 15px;
            text-align: center;
            font-size: 14px;
            color: #777;
        }
        .email-footer a {
            color: #005b96;
            text-decoration: none;
        }
        .button {
            display: inline-block;
            background-color: #005b96;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 20px;
        }
        @media (max-width: 600px) {
            .email-container {
                width: 100% !important;
            }
            .email-header h1 {
                font-size: 20px;
            }
            .email-body p {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="email-header">
        <h1>PSASB Recruitment Team</h1>
    </div>
    <div class="email-body">
        <p>Dear {{ $userName }},</p>

        <p>Congratulations! You have been appointed as a <strong>Panelist</strong> for the vacancy titled: <strong>{{ $vacancyTitle }}</strong>.</p>

        <p>Your temporary password for logging in is: <span class="password">{{ $password }}</span>.</p>

        <p>Please remember to change your password once you log in for the first time to secure your account.</p>

        <a href="{{ route('login') }}" class="button btn-success">Login to Your Account</a>
    </div>
    <div class="email-footer">
        <p>If you have any questions or issues, feel free to contact us at <a href="mailto:support@psasb.go.ke">support@psasb.go.ke</a>.</p>
        <p>Best regards,<br><strong>PSASB Recruitment Team</strong></p>
    </div>
</div>
</body>
</html>
