<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset - Eduserve</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            width: 100% !important;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            background-color: #f8fafc;
        }

        .email-wrapper {
            width: 100%;
            background-color: #f8fafc;
            padding: 40px 0;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            border: 1px solid #e2e8f0;
        }

        .email-header {
            background: linear-gradient(135deg, #0284c7 0%, #075985 100%);
            padding: 30px 40px;
            text-align: center; 
        }
        .email-header img {
            max-height: 60px;
            width: auto;
            display: block;
            margin: 0 auto;
            background: transparent;
            padding: 10px;
            border-radius: 4px;
        }
        .email-body {
            padding: 40px;
            text-align: left;
        }

        .email-body h2 {
            color: #0f172a;
            font-size: 22px;
            margin: 0 0 20px 0;
            font-family: 'Segoe UI', Arial, sans-serif;
            font-weight: 700;
        }

        .email-body p {
            color: #475569;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 24px;
            font-family: Arial, sans-serif;
        }

        .btn {
            display: inline-block;
            background-color: #075985 !important;
            padding: 14px 32px;
            border-radius: 6px;
            text-decoration: none !important;
            margin: 10px 0 30px 0;
        }

        .btn-text {
            color: #ffffff !important;
            font-weight: bold;
            font-family: Arial, sans-serif;
            font-size: 16px;
            text-decoration: none !important;
            -webkit-text-fill-color: #ffffff !important;
        }

        .email-footer {
            padding: 30px 40px;
            font-size: 12px;
            color: #94a3b8;
            text-align: left;
            background-color: #f8fafc;
            border-top: 1px solid #e2e8f0;
            font-family: Arial, sans-serif;
        }

        .apple-link a { color: #94a3b8 !important; text-decoration: none !important; }

        @media only screen and (max-width: 600px) {
            .email-wrapper { padding: 0 !important; }
            .email-container {
                width: 100% !important;
                border-radius: 0 !important;
                border: none !important;
            }
            .email-header, .email-body, .email-footer {
                padding-left: 25px !important;
                padding-right: 25px !important;
            }
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-container">
            
            <div class="email-header">
                <a href="https://www.nexovaste.com"><img src="https://i.ibb.co/b5Px0sPb/eduserve-logo.jpg" alt="eduserve logo" border="0"></a>
            </div>

            <div class="email-body">
                <p style="color: #075985; font-weight: bold; margin-bottom: 8px;">Hello {{ $fullName ?? 'EduServe Staff' }},</p>
                <h2>Password Reset Request</h2>
                <p>We received a request to reset the password for your account. Please click the button below to choose a new password. If you did not make this request, you can safely ignore this email.</p>

                <a href="{{ $url }}" class="btn">
                    <span class="btn-text">Reset Password</span>
                </a>

                <p style="font-size: 14px; color: #64748b; margin-top: 20px;">
                    For security, this link will expire in 10 minutes.
                </p>
                
                <p style="margin-top: 40px; border-top: 1px solid #f1f5f9; padding-top: 20px;">
                    Regards,<br>
                    <strong>The EduServe Team</strong>
                </p>
            </div>

            <div class="email-footer apple-link">
                &copy; {{ date('Y') }} Eduserve Academic & Administrative Platform.<br>
                This is an automated message, please do not reply.
            </div>

        </div>
    </div>
</body>
</html>