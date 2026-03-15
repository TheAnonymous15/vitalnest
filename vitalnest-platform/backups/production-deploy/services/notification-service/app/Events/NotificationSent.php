<?php

namespace NotificationService\Events;

use NotificationService\Models\Notification;

class NotificationSent
{
    public Notification $notification;
    public string $occurredAt;

    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
        $this->occurredAt = date('Y-m-d H:i:s');
    }

    public function getName(): string
    {
        return 'notification.sent';
    }

    public function getPayload(): array
    {
        return [
            'event' => $this->getName(),
            'notification_id' => $this->notification->id,
            'user_id' => $this->notification->user_id,
            'type' => $this->notification->type,
            'channel' => $this->notification->channel,
            'status' => $this->notification->status,
            'occurred_at' => $this->occurredAt
        ];
    }

    public function dispatch(): void
    {
        error_log(json_encode($this->getPayload()));
    }
}

