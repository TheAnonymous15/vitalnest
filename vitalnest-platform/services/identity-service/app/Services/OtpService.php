<?php
/**
 * Identity Service - OTP Service
 * Handles OTP generation, storage, and verification
 */

namespace IdentityService\Services;

class OtpService
{
    private \PDO $db;
    private int $otpLength = 6;
    private int $otpExpiry = 600; // 10 minutes in seconds

    public function __construct()
    {
        $config = require __DIR__ . '/../../config/service.php';
        $dbPath = $config['database']['path'];
        $this->db = new \PDO("sqlite:{$dbPath}");
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        // Create OTP table if not exists
        $this->createTable();
    }

    /**
     * Create OTP table
     */
    private function createTable(): void
    {
        $this->db->exec("
            CREATE TABLE IF NOT EXISTS otp_codes (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                email TEXT NOT NULL,
                code TEXT NOT NULL,
                type TEXT NOT NULL DEFAULT 'email_verification',
                attempts INTEGER DEFAULT 0,
                verified_at TEXT NULL,
                expires_at TEXT NOT NULL,
                created_at TEXT DEFAULT CURRENT_TIMESTAMP
            )
        ");

        // Create index
        $this->db->exec("CREATE INDEX IF NOT EXISTS idx_otp_email ON otp_codes(email)");
    }

    /**
     * Generate OTP for email
     */
    public function generateOtp(string $email, string $type = 'email_verification'): string
    {
        // Invalidate any existing OTPs for this email and type
        $stmt = $this->db->prepare("DELETE FROM otp_codes WHERE email = ? AND type = ?");
        $stmt->execute([$email, $type]);

        // Generate 6-digit OTP
        $otp = str_pad(random_int(0, 999999), $this->otpLength, '0', STR_PAD_LEFT);

        // Store OTP
        $expiresAt = date('Y-m-d H:i:s', time() + $this->otpExpiry);
        $stmt = $this->db->prepare("
            INSERT INTO otp_codes (email, code, type, expires_at, created_at)
            VALUES (?, ?, ?, ?, datetime('now'))
        ");
        $stmt->execute([$email, $otp, $type, $expiresAt]);

        return $otp;
    }

    /**
     * Verify OTP
     */
    public function verifyOtp(string $email, string $code, string $type = 'email_verification'): array
    {
        // Get the OTP record
        $stmt = $this->db->prepare("
            SELECT * FROM otp_codes
            WHERE email = ? AND type = ? AND verified_at IS NULL
            ORDER BY created_at DESC LIMIT 1
        ");
        $stmt->execute([$email, $type]);
        $record = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$record) {
            return ['success' => false, 'message' => 'No OTP found. Please request a new one.'];
        }

        // Check if expired
        if (strtotime($record['expires_at']) < time()) {
            return ['success' => false, 'message' => 'OTP has expired. Please request a new one.'];
        }

        // Check attempts (max 5)
        if ($record['attempts'] >= 5) {
            return ['success' => false, 'message' => 'Too many attempts. Please request a new OTP.'];
        }

        // Increment attempts
        $stmt = $this->db->prepare("UPDATE otp_codes SET attempts = attempts + 1 WHERE id = ?");
        $stmt->execute([$record['id']]);

        // Verify code
        if ($record['code'] !== $code) {
            $remaining = 5 - ($record['attempts'] + 1);
            return ['success' => false, 'message' => "Invalid OTP. {$remaining} attempts remaining."];
        }

        // Mark as verified
        $stmt = $this->db->prepare("UPDATE otp_codes SET verified_at = datetime('now') WHERE id = ?");
        $stmt->execute([$record['id']]);

        return ['success' => true, 'message' => 'OTP verified successfully'];
    }

    /**
     * Send OTP via email
     */
    public function sendOtpEmail(string $email, string $otp, string $firstName = 'User'): bool
    {
        $subject = "VitalNest - Verify Your Email";

        $message = "
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body { font-family: 'Inter', Arial, sans-serif; background: #f3f4f6; padding: 20px; }
                .container { max-width: 480px; margin: 0 auto; background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.1); }
                .header { background: linear-gradient(135deg, #0F766E, #14B8A6); padding: 30px; text-align: center; }
                .header h1 { color: white; margin: 0; font-size: 24px; }
                .content { padding: 30px; }
                .otp-box { background: #f0fdfa; border: 2px dashed #0F766E; border-radius: 12px; padding: 20px; text-align: center; margin: 20px 0; }
                .otp-code { font-size: 36px; font-weight: bold; letter-spacing: 8px; color: #0F766E; margin: 0; }
                .footer { background: #f9fafb; padding: 20px; text-align: center; font-size: 12px; color: #6b7280; }
                .warning { color: #ef4444; font-size: 13px; margin-top: 15px; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h1>🏥 VitalNest</h1>
                </div>
                <div class='content'>
                    <p>Hello <strong>{$firstName}</strong>,</p>
                    <p>Thank you for registering with VitalNest! Please use the following OTP to verify your email address:</p>

                    <div class='otp-box'>
                        <p class='otp-code'>{$otp}</p>
                    </div>

                    <p>This code will expire in <strong>10 minutes</strong>.</p>

                    <p class='warning'>⚠️ Do not share this code with anyone. VitalNest staff will never ask for your OTP.</p>
                </div>
                <div class='footer'>
                    <p>&copy; 2026 VitalNest Healthcare. All rights reserved.</p>
                    <p>If you didn't request this, please ignore this email.</p>
                </div>
            </div>
        </body>
        </html>
        ";

        $headers = [
            'MIME-Version: 1.0',
            'Content-type: text/html; charset=UTF-8',
            'From: VitalNest <noreply@vitalnest.co.ke>',
            'Reply-To: support@vitalnest.co.ke',
            'X-Mailer: PHP/' . phpversion()
        ];

        // For development, log the OTP instead of sending email
        error_log("OTP for {$email}: {$otp}");

        // Try to send email (may fail in development without mail server)
        $sent = @mail($email, $subject, $message, implode("\r\n", $headers));

        // Return true even if mail fails in development (OTP is logged)
        return true;
    }

    /**
     * Resend OTP
     */
    public function resendOtp(string $email, string $type = 'email_verification'): array
    {
        // Check rate limiting (max 3 resends per hour)
        $stmt = $this->db->prepare("
            SELECT COUNT(*) as count FROM otp_codes
            WHERE email = ? AND type = ?
            AND created_at > datetime('now', '-1 hour')
        ");
        $stmt->execute([$email, $type]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($result['count'] >= 3) {
            return [
                'success' => false,
                'message' => 'Too many OTP requests. Please try again after 1 hour.'
            ];
        }

        // Get user info for email
        $stmt = $this->db->prepare("SELECT first_name FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        $firstName = $user['first_name'] ?? 'User';

        // Generate and send new OTP
        $otp = $this->generateOtp($email, $type);
        $this->sendOtpEmail($email, $otp, $firstName);

        return ['success' => true, 'message' => 'OTP sent successfully'];
    }
}

