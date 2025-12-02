<?php

namespace App\Http\Controllers;

use App\Services\ItineraryService;
use App\Services\OpenAIService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class PackageController extends Controller
{
    public function index()
    {
        return view('packages.index');
    }

    public function generateItinerary(Request $request)
    {
        $data = $request->validate([
            'from' => 'required|string',
            'to' => 'required|string',
            'duration' => 'required|integer|min:1',
        ]);

        try {
            $days = intval($data['duration']);

            $itineraryService = new ItineraryService;
            $prompt = $itineraryService->generatePrompt($data);

            // Prepare payload
            $payload = [
                'model' => 'gpt-4o-mini',
                'messages' => [
                    ['role' => 'user', 'content' => $prompt]
                ],
                'temperature' => 0.7,
            ];

            // Call OpenAI API
            $openAiAPI = new OpenAIService;
            $response = $openAiAPI->openAiAPI($payload);

            // Extract AI response
            $aiResponse = $response->json();
            $content = $aiResponse['choices'][0]['message']['content'] ?? '{}';

            // Decode JSON returned by AI
            $itinerary = json_decode($content, true);

            return response()->json([
                'success' => true,
                'days' => $days,
                'data' => $itinerary
            ]);
        } catch (Throwable $e) {
            // Log the full error for debugging
            Log::error('Itinerary Generation Failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while generating the itinerary.',
                'error_detail' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }
}
