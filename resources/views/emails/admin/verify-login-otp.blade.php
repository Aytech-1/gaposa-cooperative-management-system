<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Login - Unity Co-op</title>
    <style>
        body, html { margin: 0; padding: 0; width: 100% !important; background-color: #f0f4f8; }
        .email-wrapper { width: 100%; background-color: #f0f4f8; padding: 40px 0; }
        
        .email-container {
            max-width: 500px; margin: 0 auto; background: #ffffff;
            border-radius: 12px; overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0;
        }

        .header {
            background-color: #2d5a27; /* Forest Green from logo */
            padding: 30px; text-align: center; 
        }
        .header img {
            max-height: 70px; width: auto; display: block; margin: 0 auto;
        }

        .email-body { padding: 40px; text-align: center; font-family: 'Segoe UI', Arial, sans-serif; }

        .email-body h2 { color: #1a202c; font-size: 22px; margin: 0 0 10px 0; font-weight: 700; }
        .email-body p { color: #4a5568; font-size: 16px; line-height: 1.6; margin-bottom: 25px; }

        /* OTP Code Styling */
        .otp-container {
            background-color: #fcf9f2; /* Earth Gold tint */
            border: 2px dashed #e9d1a1;
            border-radius: 8px;
            padding: 20px;
            margin: 30px 0;
            display: inline-block;
            min-width: 200px;
        }
        .otp-code {
            font-size: 36px;
            font-weight: 800;
            letter-spacing: 8px;
            color: #2d5a27;
            margin: 0;
        }

        .timer-notice {
            color: #c53030;
            font-size: 13px;
            font-weight: 600;
            margin-top: 10px;
        }

        /* Incident Details Info */
        .details-info {
            font-size: 13px;
            color: #718096;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #edf2f7;
        }

        .footer {
            padding: 25px; font-size: 11px; color: #94a3b8;
            text-align: center; background-color: #f8fafc; border-top: 1px solid #e2e8f0;
        }
    </style>
</head>

<body>
    <div class="email-wrapper">
        <div class="email-container">

            <div class="header">
                <img src="https://i.ibb.co/nMywS2Xc/Gemini-Generated-Image-xg0vfkxg0vfkxg0v.png" alt="Unity Co-op Logo">
            </div>

            <div class="email-body">
                <h2>Verify Your Identity</h2>
                <p>Hello <strong>{{ $title }}. {{ $fullName }}</strong>,</p>
                <p>Please use the following One-Time Password (OTP) to complete your login to the Cooperative Portal.</p>

                <div class="otp-container">
                    <h1 class="otp-code">{{ $otp }}</h1>
                    <div class="timer-notice">⏱ Valid for 10 minutes only</div>
                </div>

                <p style="font-size: 14px;">If you did not request this code, please secure your account immediately or contact the system administrator.</p>

                <div class="details-info">
                    Requested from: <b>{{ $location }}</b><br>
                    Device: <b>{{ $device }}</b>
                </div>
            </div>

            <div class="footer">
                &copy; {{ date('Y') }} <b>Unity Cooperative Society</b><br>
                Strength in Community & Growth<br>
                Staff Authentication Service
            </div>

        </div>
    </div>
</body>

</html>