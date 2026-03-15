<?php
/**
 * Manual Autoloader for Identity Service
 * This is a temporary solution until Composer is available
 */

spl_autoload_register(function ($class) {
    // Convert namespace to file path
    $prefix = 'IdentityService\\';
    $base_dir = __DIR__ . '/../app/';

    // Does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // No, move to the next registered autoloader
        return;
    }

    // Get the relative class name
    $relative_class = substr($class, $len);

    // Replace namespace separators with directory separators
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // If the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});

// Simple JWT functions (minimal implementation)
if (!class_exists('Firebase\JWT\JWT')) {
    class JWT {
        public static function encode($payload, $key, $alg = 'HS256') {
            $header = ['typ' => 'JWT', 'alg' => $alg];

            $segments = [];
            $segments[] = self::urlsafeB64Encode(json_encode($header));
            $segments[] = self::urlsafeB64Encode(json_encode($payload));

            $signing_input = implode('.', $segments);
            $signature = self::sign($signing_input, $key, $alg);
            $segments[] = self::urlsafeB64Encode($signature);

            return implode('.', $segments);
        }

        public static function decode($jwt, $key) {
            $segments = explode('.', $jwt);
            if (count($segments) != 3) {
                throw new Exception('Invalid token format');
            }

            list($headb64, $bodyb64, $cryptob64) = $segments;

            $header = json_decode(self::urlsafeB64Decode($headb64));
            $payload = json_decode(self::urlsafeB64Decode($bodyb64));

            return $payload;
        }

        private static function urlsafeB64Encode($input) {
            return str_replace('=', '', strtr(base64_encode($input), '+/', '-_'));
        }

        private static function urlsafeB64Decode($input) {
            $remainder = strlen($input) % 4;
            if ($remainder) {
                $padlen = 4 - $remainder;
                $input .= str_repeat('=', $padlen);
            }
            return base64_decode(strtr($input, '-_', '+/'));
        }

        private static function sign($msg, $key, $alg) {
            return hash_hmac('sha256', $msg, $key, true);
        }
    }
}

// Alias for Firebase JWT
class_alias('JWT', 'Firebase\JWT\JWT');
