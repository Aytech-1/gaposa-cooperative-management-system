<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Platform Deployment Successful – {{ $schoolName }}</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            width: 100% !important;
            background-color: #f8fafc;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        .email-wrapper {
            width: 100%;
            padding: 40px 0;
            background-color: #f8fafc;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            box-shadow: 0 6px 20px rgba(15, 23, 42, 0.08);
        }

        /* Header */
        .email-header {
            background: linear-gradient(135deg, #0284c7 0%, #075985 100%);
            padding: 36px 40px;
            text-align: center;
        }

        .email-header img {
            max-height: 58px;
            display: block;
            margin: 0 auto;
        }

        /* Body */
        .email-body {
            padding: 40px;
            color: #334155;
        }

        .status-banner {
            background-color: #f0fdf4;
            border-left: 4px solid #16a34a;
            padding: 14px 16px;
            font-size: 14px;
            color: #166534;
            border-radius: 4px;
            margin-bottom: 28px;
        }

        .email-body h2 {
            font-size: 24px;
            color: #0f172a;
            margin: 0 0 16px;
            font-weight: 700;
        }

        .email-body p {
            font-size: 16px;
            line-height: 1.65;
            margin-bottom: 22px;
            color: #475569;
        }

        /* Configuration Card */
        .config-card {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 24px;
            margin: 28px 0;
        }

        .config-title {
            font-size: 12px;
            font-weight: 700;
            color: #0284c7;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 16px;
            display: block;
        }

        .config-row {
            font-size: 14px;
            margin-bottom: 12px;
            color: #334155;
        }

        .config-label {
            font-weight: 600;
            color: #64748b;
            width: 130px;
            display: inline-block;
        }

        /* Button */
        .btn-container {
            text-align: center;
            margin: 36px 0;
        }

        .btn {
            display: inline-block;
            background-color: #075985;
            padding: 16px 36px;
            border-radius: 6px;
            text-decoration: none;
        }

        .btn span {
            color: #ffffff;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
        }

        /* Footer */
        .email-footer {
            padding: 30px 40px;
            font-size: 12px;
            color: #94a3b8;
            background-color: #f8fafc;
            border-top: 1px solid #e2e8f0;
            line-height: 1.6;
            text-align: center;
        }

        @media only screen and (max-width: 600px) {
            .email-wrapper {
                padding: 0 !important;
            }

            .email-container {
                width: 100% !important;
                border-radius: 0 !important;
            }

            .email-header,
            .email-body,
            .email-footer {
                padding-left: 24px !important;
                padding-right: 24px !important;
            }
        }
    </style>
</head>
<body>
<div class="email-wrapper">
    <div class="email-container">

        <!-- Header -->
        <div class="email-header">
            <img src="https://i.ibb.co/b5Px0sPb/eduserve-logo.jpg" alt="Eduserve Logo">
        </div>

        <!-- Body -->
        <div class="email-body">

            <div class="status-banner">
                <strong>Deployment Successful:</strong> Your institutional environment is now live and operational.
            </div>

            <h2>Welcome, {{ $title }}. {{ $fullName }}</h2>

            <p>
                We are pleased to inform you that the Eduserve platform has been successfully deployed for
                <strong>{{ $schoolName }}</strong>. Your institution’s secure cloud environment is now fully provisioned and ready for use.
            </p>

            <div class="config-card">
                <span class="config-title">Institution Configuration</span>

                <div class="config-row">
                    <span class="config-label">Institution Name:</span> {{ $schoolName }}
                </div>

                <div class="config-row">
                    <span class="config-label">Administrator Email:</span> {{ $adminEmail }}
                </div>

                <div class="config-row">
                    <span class="config-label">Admin password:</span> {{ $password }}
                </div>
            </div>

            <p>
                You may now proceed to the administrative dashboard to complete your institution profile,
                manage users, and configure system settings.
            </p>

            <div class="btn-container">
                <a href="" class="btn">
                    <span>Access Admin Dashboard</span>
                </a>
            </div>

            <p style="font-size: 14px; color: #64748b; text-align: center;">
                Should you require assistance during onboarding, our support team is available to help.
            </p>

        </div>

        <!-- Footer -->
        <div class="email-footer">
            © {{ date('Y') }} Eduserve Academic & Administrative Platform.<br>
            This message was generated automatically as part of your institution’s onboarding process.<br>
            Please do not reply to this email.
        </div>

    </div>
</div>
</body>
</html>
