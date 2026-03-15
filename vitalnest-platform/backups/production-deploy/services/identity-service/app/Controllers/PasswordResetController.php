<?php

namespace IdentityService\Controllers;

class PasswordResetController
{
    private $db;

    public function __construct()
    {
        $dbPath = __DIR__ . '/../../../../database/vitalnest_identity.db';
        $this->db = new \PDO('sqlite:' . $dbPath);
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function requestReset()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $email = $input['email'] ?? '';
        $phone = $input['phone'] ?? '';

        if (!$email && !$phone) {
            return ['success' => false, 'message' => 'Email or phone number is required'];
        }

        if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['success' => false, 'message' => 'Valid email is required'];
        }

        if ($email) {
            $stmt = $this->db->prepare("SELECT id, first_name, email FROM users WHERE email = ? AND role = 'client'");
            $stmt->execute([$email]);
        } else {
            $stmt = $this->db->prepare("SELECT id, first_name, email FROM users WHERE phone = ? AND role = 'client'");
            $stmt->execute([$phone]);
        }

        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$user) {
            $identifier = $email ? 'email address' : 'phone number';
            return [
                'success' => false,
                'message' => 'No account found with this ' . $identifier . '. Please check and try again or register a new account.'
            ];
        }

        $token = bin2hex(random_bytes(32));
        $expiresAt = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $this->db->prepare("UPDATE password_resets SET used = 1 WHERE email = ? AND used = 0")->execute([$user['email']]);

        $stmt = $this->db->prepare("INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, ?)");
        $stmt->execute([$user['email'], $token, $expiresAt]);

        return [
            'success' => true,
            'message' => 'Password reset instructions sent',
            'dev_token' => $token
        ];
    }

    public function resetPassword()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $token = $input['token'] ?? '';
        $newPassword = $input['new_password'] ?? '';

        if (!$token || !$newPassword) {
            return ['success' => false, 'message' => 'Token and new password are required'];
        }

        if (strlen($newPassword) < 6) {
            return ['success' => false, 'message' => 'Password must be at least 6 characters'];
        }

        $stmt = $this->db->prepare("
            SELECT email FROM password_resets
            WHERE token = ? AND used = 0 AND datetime(expires_at) > datetime('now')
        ");
        $stmt->execute([$token]);
        $reset = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$reset) {
            return ['success' => false, 'message' => 'Invalid or expired reset token'];
        }

        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("UPDATE users SET password = ?, updated_at = datetime('now') WHERE email = ?");
        $stmt->execute([$hashedPassword, $reset['email']]);

        $this->db->prepare("UPDATE password_resets SET used = 1 WHERE token = ?")->execute([$token]);

        return [
            'success' => true,
            'message' => 'Password reset successful! You can now login with your new password.'
        ];
    }
}

