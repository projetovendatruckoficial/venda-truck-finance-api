<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WebhookService
{
    /**
     * Send a webhook notification to N8N
     *
     * @param string $event The event type (e.g., 'simulation.created', 'simulation.updated')
     * @param array $data The data to send to the webhook
     * @return bool
     */
    public static function send(string $event, array $data): bool
    {
        $webhookUrl = config('app.webhook_n8n');

        if (!$webhookUrl) {
            Log::warning('WEBHOOK_N8N environment variable is not configured');
            return false;
        }

        try {
            $payload = [
                'event' => $event,
                'timestamp' => now()->toIso8601String(),
                'data' => $data,
            ];

            Http::timeout(30)->post($webhookUrl, $payload);

            Log::info("Webhook sent for event: {$event}", [
                'url' => $webhookUrl,
                'data' => $data,
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send webhook for event: {$event}", [
                'error' => $e->getMessage(),
                'url' => $webhookUrl,
            ]);

            return false;
        }
    }
}
