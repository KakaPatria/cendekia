<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kode OTP Reset Password</title>
</head>
<body>
    <p>Halo {{ $user->name }},</p>
    <p>Anda meminta reset password. Gunakan kode OTP di bawah ini untuk melanjutkan proses reset password:</p>
    <h2 style="letter-spacing:4px">{{ $otp }}</h2>
    <p>Kode ini berlaku selama 10 menit. Jika Anda tidak meminta reset password, abaikan email ini.</p>
    <p>Salam,<br/>Tim Cendekia</p>
</body>
</html>