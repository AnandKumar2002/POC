<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenAIService
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

    public function openAiAPI($payload)
    {
        $response = Http::withToken($this->apiKey)
            ->acceptJson()
            ->post($this->apiUrl, $payload);

        if ($response->failed()) {
            Log::error('OpenAI itinerary generation failed', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            return response()->json([
                'error' => 'OpenAI request failed',
                'details' => $response->json()
            ], 500);
        }

        return $response;
    }
}