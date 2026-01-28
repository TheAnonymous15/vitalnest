<?php
}
    return (new JWT())->validate($token);
{
function jwt_validate(string $token): bool

}
    return (new JWT())->decode($token);
{
function jwt_decode(string $token): ?array

}
    return (new JWT())->encode($payload);
{
function jwt_encode(array $payload): string
// Helper functions for quick access

}
    }
        return base64_decode(strtr($data, '-_', '+/'));
    {
    private function base64UrlDecode(string $data): string
     */
     * Base64 URL decode
    /**

    }
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    {
    private function base64UrlEncode(string $data): string
     */
     * Base64 URL encode
    /**

    }
        return $this->base64UrlEncode($signature);
        $signature = hash_hmac('sha256', $data, $this->secret, true);
    {
    private function sign(string $data): string
     */
     * Create signature
    /**

    }
        return json_decode($this->base64UrlDecode($parts[1]), true);

        }
            return null;
        if (count($parts) !== 3) {

        $parts = explode('.', $token);
    {
    public function getPayload(string $token): ?array
     */
     * Get payload without validation
    /**

    }
        return $this->decode($token) !== null;
    {
    public function validate(string $token): bool
     */
     * Validate token
    /**

    }
        return $payload;

        }
            return null;
        if (isset($payload['exp']) && $payload['exp'] < time()) {
        // Check expiration

        $payload = json_decode($this->base64UrlDecode($payloadEncoded), true);

        }
            return null;
        if (!hash_equals($expectedSignature, $signature)) {

        $expectedSignature = $this->sign("{$headerEncoded}.{$payloadEncoded}");
        // Verify signature

        [$headerEncoded, $payloadEncoded, $signature] = $parts;

        }
            return null;
        if (count($parts) !== 3) {

        $parts = explode('.', $token);
    {
    public function decode(string $token): ?array
     */
     * Decode JWT token
    /**

    }
        return "{$header}.{$payloadEncoded}.{$signature}";

        $signature = $this->sign("{$header}.{$payloadEncoded}");

        $payloadEncoded = $this->base64UrlEncode(json_encode($payload));

        $payload['exp'] = $payload['exp'] ?? time() + 3600;
        $payload['iat'] = $payload['iat'] ?? time();

        ]));
            'alg' => $this->algorithm
            'typ' => 'JWT',
        $header = $this->base64UrlEncode(json_encode([
    {
    public function encode(array $payload): string
     */
     * Encode payload to JWT token
    /**

    }
        $this->algorithm = $algorithm;
        $this->secret = $secret ?? getenv('JWT_SECRET') ?? 'vitalnest-secret-key';
    {
    public function __construct(?string $secret = null, string $algorithm = 'HS256')

    private string $algorithm;
    private string $secret;
{
class JWT

namespace Vitalnest\Shared\Auth;

 */
 * Vitalnest Platform - JWT Utilities
/**

