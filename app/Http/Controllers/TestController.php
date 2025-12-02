<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
{
    protected string $apiKey;
    protected string $apiUrl = 'https://api.openai.com/v1/chat/completions';

    public function __construct()
    {
        $this->apiKey = env('OPEN_AI_KEY');

        if (!$this->apiKey) {
            throw new \Exception('OpenAI API key is not configured.');
        }
    }

    public function testConnection(): array
    {
        $payload = [
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'user', 'content' => "What is laravel?"]
            ]
        ];

        $response = Http::withToken($this->apiKey)
            ->acceptJson()
            ->post($this->apiUrl, $payload);

        if ($response->failed()) {
            Log::error('OpenAI test failed', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            throw new \Exception('OpenAI test failed: ' . $response->body());
        }

        return $response->json();
    }
}
