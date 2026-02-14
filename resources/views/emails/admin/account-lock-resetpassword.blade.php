<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Account Locked - Cooperative Portal</title>
    <style>
        body {
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #f0f4f8;
            color: #2d3748;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }

        .wrapper {
            width: 100%;
            background-color: #f0f4f8;
            padding: 40px 0;
        }

        .main {
            background-color: #ffffff;
            margin: 0 auto;
            max-width: 600px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }

        /* HEADER */
        .header {
            background-color: #2d5a27; 
            padding: 35px;
            text-align: center;
        }

        .header img {
            width: 90px;
            height: auto;
            margin-bottom: 15px;
        }

        .header h2 {
            color: #ffffff;
            margin: 0;
            font-size: 14px;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-weight: 400;
            opacity: 0.9;
        }

        /* SECURITY BANNER */
        .security-banner {
            background-color: #fff5f5;
            border-bottom: 1px solid #fed7d7;
            padding: 12px 20px;
            color: #c53030;
            font-size: 14px;
            text-align: center;
        }

        .content {
            padding: 40px;
        }

        .content h1 {
            color: #1a202c;
            font-size: 22px;
            margin-top: 0;
            text-align: center;
            font-weight: 700;
        }

        .content p {
            font-size: 16px;
            line-height: 1.6;
            color: #4a5568;
        }

        /* DETAILS CARD */
        .details-card {
            background-color: #fcf9f2;
            border: 1px solid #e9d1a1;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
        }

        .detail-row {
            font-size: 14px;
            margin-bottom: 8px;
            color: #5d4037;
            display: flex;
        }

        .detail-label {
            width: 100px;
            font-weight: 700;
            color: #2d5a27;
        }

        /* BUTTON & EXPIRATION */
        .cta-container {
            text-align: center;
            margin: 35px 0;
        }

        .button {
            background-color: #2d5a27;
            color: #ffffff !important;
            padding: 16px 32px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            display: inline-block;
            box-shadow: 0 4px 6px rgba(45, 90, 39, 0.2);
        }

        .expiry-notice {
            display: block;
            margin-top: 15px;
            color: #be123c;
            font-size: 13px;
            font-weight: bold;
        }

        /* FOOTER */
        .footer {
            text-align: center;
            padding: 30px;
            font-size: 12px;
            color: #718096;
            background-color: #f8fafc;
            border-top: 1px solid #e2e8f0;
        }

        .footer b {
            color: #4a5568;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="main">

            <div class="header">
                <img src="https://i.ibb.co/nMywS2Xc/Gemini-Generated-Image-xg0vfkxg0vfkxg0v.png" alt="Unity Co-op Logo">
                <h2>Unity Cooperative Society</h2>
            </div>

            <div class="security-banner">
                <strong>Security Notice:</strong> Your account has been locked for your protection.
            </div>

            <div class="content">
                <h1>Administrative Access Locked</h1>

                <p>Hello <strong>{{ $title }}. {{ $fullName }}</strong>,</p>

                <p>
                    For the security of the cooperative's financial data and member records, your administrative account has been automatically locked following multiple failed authentication attempts.
                </p>

                <div class="details-card">
                    <div class="detail-row"><span class="detail-label">Device:</span> {{ $device }}</div>
                    <div class="detail-row"><span class="detail-label">Browser:</span> {{ $browser }}</div>
                    <div class="detail-row"><span class="detail-label">Location:</span> {{ $location }}</div>
                </div>

                <p>To restore access to the Administration Portal, please complete the identity verification process:</p>

                <div class="cta-container">
                    <a href="{{ $url }}" class="button">
                        Verify Identity & Unlock
                    </a>
                    <span class="expiry-notice">⏱ This security link will expire in 10 minutes</span>
                </div>

                <p style="font-size:14px; color:#718096; text-align: center; font-style: italic;">
                    If you did not attempt this login, please alert the Security Committee immediately.
                </p>
            </div>

            <div class="footer">
                <p>
                    &copy; {{ date('Y') }} <b>Unity Cooperative Society</b><br>
                    Strength in Community & Growth<br>
                    <i>Portal Security Notification System</i>
                </p>
            </div>

        </div>
    </div>
</body>

</html>