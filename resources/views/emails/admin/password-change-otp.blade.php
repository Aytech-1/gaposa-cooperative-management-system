<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Password Change - Eduserve</title>
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

        .btn-container { text-align: center; margin: 35px 0; }
        .btn {
            display: inline-block;
            background-color: #be123c !important; 
            padding: 16px 35px;
            border-radius: 6px;
            text-decoration: none !important;
        }
        .btn-text {
            color: #ffffff !important;
            font-weight: bold;
            font-size: 16px;
            text-decoration: none !important;
            -webkit-text-fill-color: #ffffff !important;
        }

        .email-footer {
            padding: 30px 40px; font-size: 12px; color: #94a3b8;
            text-align: left; background-color: #f8fafc; border-top: 1px solid #e2e8f0;
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
                <p style="color: #075985; font-weight: bold; margin-bottom: 8px;">Security Confirmation</p>
                <h2>Change Your Password</h2>
                <p>A request has been made to change your Eduserve account password. Click the button below to confirm this change and set your new password:</p>

                <div class="btn-container">
                    <a href="{{ $url }}" class="btn">
                        <span class="btn-text">Confirm Password Change</span>
                    </a>
                </div>

                <p style="font-size: 14px; color: #64748b;">
                    <strong>Security Note:</strong>⏱ This link will expire in 10 minutes. If you did not request a password change, please ignore this email or contact support if you have concerns.
                </p>
            </div>

            <div class="email-footer">
                &copy; {{ date('Y') }} Eduserve Academic & Administrative Platform.<br>
                This is a secure automated message. Please do not reply.
            </div>

        </div>
    </div>
</body>
</html>