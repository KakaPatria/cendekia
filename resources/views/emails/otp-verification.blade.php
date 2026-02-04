<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode Verifikasi Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #DBB83E 0%, #E6C96B 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 30px;
        }
        .otp-box {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: 3px dashed #DBB83E;
            padding: 25px;
            text-align: center;
            margin: 25px 0;
            border-radius: 10px;
        }
        .otp-code {
            font-size: 42px;
            font-weight: bold;
            color: #7A1111;
            letter-spacing: 10px;
            font-family: 'Courier New', monospace;
            margin: 10px 0;
        }
        .warning {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .footer {
            background: #333;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 12px;
        }
        .highlight {
            color: #7A1111;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎓 Cendekia LMS</h1>
            <p style="margin: 5px 0 0 0; font-size: 14px;">Verifikasi Email Anda</p>
        </div>

        <div class="content">
            <p>Halo,</p>
            
            <p>Terima kasih telah mendaftar di <strong>Cendekia LMS</strong>! Untuk melanjutkan proses pendaftaran, silakan gunakan kode verifikasi di bawah ini:</p>

            <div class="otp-box">
                <p style="margin: 0; color: #666; font-size: 14px;">Kode Verifikasi Anda:</p>
                <div class="otp-code">{{ $otp }}</div>
                <p style="margin: 10px 0 0 0; color: #999; font-size: 12px;">Berlaku selama <span class="highlight">10 menit</span></p>
            </div>

            <div class="warning">
                <strong>⚠️ Penting:</strong>
                <ul style="margin: 10px 0 0 0; padding-left: 20px;">
                    <li>Kode OTP ini hanya berlaku selama <strong>10 menit</strong></li>
                    <li>Jangan bagikan kode ini kepada siapapun</li>
                    <li>Jika Anda tidak merasa mendaftar, abaikan email ini</li>
                </ul>
            </div>

            <p>Masukkan kode OTP di halaman pendaftaran untuk melanjutkan.</p>

            <p style="margin-top: 30px;">
                Salam hangat,<br>
                <strong>Tim Cendekia LMS</strong>
            </p>
        </div>

        <div class="footer">
            <p style="margin: 0;">&copy; {{ date('Y') }} Cendekia LMS. All rights reserved.</p>
            <p style="margin: 5px 0 0 0;">Email ini dikirim secara otomatis, mohon tidak membalas.</p>
        </div>
    </div>
</body>
</html>
