Gmail SMTP setup (local development)

This project uses Laravel's mail system. To send OTP emails via Gmail's SMTP, set the following in your .env (for local dev/testing):

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your.email@gmail.com
MAIL_PASSWORD=your_app_password_or_oauth_token
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your.email@gmail.com
MAIL_FROM_NAME="Your App Name"

Notes:
- For Gmail, using an "App Password" (recommended) or OAuth2 is required. If your account has 2FA enabled, create an App Password and use it as MAIL_PASSWORD.
- If you don't have 2FA, less-secure apps have been disabled by Google; use an App Password or set up a proper mail provider (SendGrid, Mailgun).
- After editing .env, restart any queue/workers and run: php artisan config:clear && php artisan cache:clear

Troubleshooting:
- If you see authentication errors, double-check username/password and that your account allows SMTP access.
- For local testing without sending real emails, consider using Mailtrap, Mailhog, or log driver (MAIL_MAILER=log).

Example .env snippet for Gmail (using app password):

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=youremail@gmail.com
MAIL_PASSWORD=abcd efgh ijkl mnop
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=youremail@gmail.com
MAIL_FROM_NAME="Cendekia"
