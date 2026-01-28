<?php
/**
 * Notification Service - Notification Template Model
 */

namespace NotificationService\Models;

class NotificationTemplate
{
    protected string $table = 'notification_templates';

    public int $id;
    public string $name;
    public string $slug;
    public string $type;
    public string $subject;
    public string $body;
    public ?array $variables;
    public array $channels;
    public bool $is_active;
    public string $created_at;

    public function render(array $data): array
    {
        $subject = $this->subject;
        $body = $this->body;

        foreach ($data as $key => $value) {
            $subject = str_replace('{{' . $key . '}}', $value, $subject);
            $body = str_replace('{{' . $key . '}}', $value, $body);
        }

        return [
            'subject' => $subject,
            'body' => $body
        ];
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'type' => $this->type,
            'subject' => $this->subject,
            'body' => $this->body,
            'variables' => $this->variables,
            'channels' => $this->channels,
            'is_active' => $this->is_active
        ];
    }
}

