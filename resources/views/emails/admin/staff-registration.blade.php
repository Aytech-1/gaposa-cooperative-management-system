<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Eduserve</title>
    <style>
        body, html { margin: 0; padding: 0; width: 100% !important; background-color: #f8fafc; }
        .email-wrapper { width: 100%; background-color: #f8fafc; padding: 40px 0; }
        .email-container {
            max-width: 600px; margin: 0 auto; background: #ffffff;
            border-radius: 8px; overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); border: 1px solid #e2e8f0;
        }
        .email-header {
            background: linear-gradient(135deg, #0284c7 0%, #075985 100%);
            padding: 30px 40px; text-align: center; 
        }
        .email-header img {
            max-height: 60px; width: auto; display: block; margin: 0 auto;
            background: transparent; padding: 10px; border-radius: 4px;
        }
        .email-body { padding: 40px; text-align: left; font-family: 'Segoe UI', Arial, sans-serif; }
        .email-body h2 { color: #0f172a; font-size: 22px; margin: 0 0 15px 0; font-weight: 700; }
        .email-body p { color: #475569; font-size: 16px; line-height: 1.6; margin-bottom: 20px; }

        /* Focused Password Box */
        .password-container {
            background-color: #f1f5f9; border-radius: 8px;
            padding: 24px; text-align: center; margin: 30px 0;
            border: 1px solid #cbd5e1;
        }
        .password-label { font-size: 13px; color: #64748b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; display: block; }
        .password-text { font-family: 'Courier New', monospace; font-weight: bold; color: #075985; font-size: 24px; }

        /* Action Button */
        .btn-container { text-align: center; margin: 30px 0; }
        .btn {
            display: inline-block;
            background-color: #075985 !important;
            padding: 16px 35px;
            border-radius: 6px;
            text-decoration: none !important;
        }
        .btn-text {
            color: #ffffff !important;
            font-weight: bold; font-size: 16px;
            text-decoration: none !important;
            -webkit-text-fill-color: #ffffff !important;
        }

        .email-footer {
            padding: 30px 40px; font-size: 11px; color: #94a3b8;
            text-align: center; background-color: #f8fafc; border-top: 1px solid #e2e8f0;
        }

        @media only screen and (max-width: 600px) {
            .email-wrapper { padding: 0 !important; }
            .email-container { width: 100% !important; border-radius: 0 !important; }
            .email-header, .email-body, .email-footer { padding-left: 25px !important; padding-right: 25px !important; }
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-container">

            <div class="email-header">
                <a href="https://www.nexovaste.com">
                    <img src="https://i.ibb.co/b5Px0sPb/eduserve-logo.jpg" alt="eduserve logo" border="0">
                </a>
            </div>

            <div class="email-body">
                <p style="color: #075985; font-weight: bold; margin-bottom: 8px;">Welcome to EduServe!</p>
                <h2>Account Ready</h2>
                <p>Hello {{ $fullName }},</p>
                <p>Your staff profile has been created successfully. Please use the <strong>email address you used to register</strong> and the default password provided below to log in:</p>

                <div class="password-container">
                    <span class="password-label">Your Default Password</span>
                    <span class="password-text">{{ $password }}</span>
                </div>

                <div class="btn-container">
                    <a href="#" class="btn">
                        <span class="btn-text">Sign In to Eduserve</span>
                    </a>
                </div>

                <p style="color: #475569; font-size: 16px; line-height: 1.6;">
                    To ensure your account remains secure, we recommend that you **change this default password** immediately after your first login.
                </p>
                
                <p style="color: #475569; font-size: 16px; line-height: 1.6;">
                    If you have any questions, please reach out to the IT support team.
                </p>
            </div>

            <div class="email-footer">
                &copy; {{ date('Y') }} Eduserve Academic & Administrative Platform.<br>
                This is an automated welcome message. Please do not reply.
            </div>

        </div>
    </div>
</body>
</html>