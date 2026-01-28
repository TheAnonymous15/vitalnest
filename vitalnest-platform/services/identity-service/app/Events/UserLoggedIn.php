<?php
/**
 * Identity Service - User Logged In Event
 */

namespace IdentityService\Events;

use IdentityService\Models\User;

class UserLoggedIn
{
    public User $user;
    public string $occurredAt;
    public ?string $ipAddress;
    public ?string $userAgent;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->occurredAt = date('Y-m-d H:i:s');
        $this->ipAddress = $_SERVER['REMOTE_ADDR'] ?? null;
        $this->userAgent = $_SERVER['HTTP_USER_AGENT'] ?? null;
    }

    /**
     * Get event name
     */
    public function getName(): string
    {
        return 'user.logged_in';
    }

    /**
     * Get event payload
     */
    public function getPayload(): array
    {
        return [
            'event' => $this->getName(),
            'user_id' => $this->user->id,
            'email' => $this->user->email,
            'ip_address' => $this->ipAddress,
            'user_agent' => $this->userAgent,
            'occurred_at' => $this->occurredAt
        ];
    }

    /**
     * Dispatch event to message queue
     */
    public function dispatch(): void
    {
        // Publish to RabbitMQ/Redis queue
        // This would trigger:
        // - Create login audit log
        // - Check for suspicious activity
        // - Update user analytics

        error_log(json_encode($this->getPayload()));
    }
}

