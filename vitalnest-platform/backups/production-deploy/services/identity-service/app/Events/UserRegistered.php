<?php
/**
 * Identity Service - User Registered Event
 */

namespace IdentityService\Events;

use IdentityService\Models\User;

class UserRegistered
{
    public User $user;
    public string $occurredAt;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->occurredAt = date('Y-m-d H:i:s');
    }

    /**
     * Get event name
     */
    public function getName(): string
    {
        return 'user.registered';
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
            'role' => $this->user->role,
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
        // - Send welcome email
        // - Create audit log entry
        // - Notify admin of new registration

        error_log(json_encode($this->getPayload()));
    }
}

