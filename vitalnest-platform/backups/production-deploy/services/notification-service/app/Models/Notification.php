<?php
/**
 * Notification Service - Notification Model
 */

namespace NotificationService\Models;

class Notification
{
    protected string $table = 'notifications';

    public int $id;
    public int $user_id;
    public string $type;
    public string $channel;
    public string $title;
    public string $message;
    public ?array $data;
    public ?string $action_url;
    public string $status;
    public ?string $read_at;
    public ?string $sent_at;
    public string $created_at;

    public const TYPE_INFO = 'info';
    public const TYPE_SUCCESS = 'success';
    public const TYPE_WARNING = 'warning';
    public const TYPE_ERROR = 'error';
    public const TYPE_APPOINTMENT = 'appointment';
    public const TYPE_LAB_RESULT = 'lab_result';
    public const TYPE_VITALS_ALERT = 'vitals_alert';
    public const TYPE_SYSTEM = 'system';

    public const CHANNEL_EMAIL = 'email';
    public const CHANNEL_SMS = 'sms';
    public const CHANNEL_PUSH = 'push';
    public const CHANNEL_IN_APP = 'in_app';

    public const STATUS_PENDING = 'pending';
    public const STATUS_SENT = 'sent';
    public const STATUS_DELIVERED = 'delivered';
    public const STATUS_FAILED = 'failed';

    public function isRead(): bool
    {
        return $this->read_at !== null;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'type' => $this->type,
            'channel' => $this->channel,
            'title' => $this->title,
            'message' => $this->message,
            'data' => $this->data,
            'action_url' => $this->action_url,
            'status' => $this->status,
            'is_read' => $this->isRead(),
            'read_at' => $this->read_at,
            'sent_at' => $this->sent_at,
            'created_at' => $this->created_at
        ];
    }
}

