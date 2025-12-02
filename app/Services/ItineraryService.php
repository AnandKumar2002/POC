<?php

namespace App\Services;

class ItineraryService
{
    public function generatePrompt($data)
    {
        $days = intval($data['duration']);

        $prompt = "
            You are a smart travel assistant specializing in India.

            User Inputs:
            - Origin Input: \"{$data['from']}\"
            - Destination Input: \"{$data['to']}\"
            - Duration: {$days} Days

            TASK:
            1. **VALIDATION & CORRECTION:**
            - Try to correct the spelling of Origin and Destination to the nearest valid cities.
            - **IF SPELLING IS TOO INCORRECT/GIBBERISH:** If you cannot identify the city (e.g., input is 'sdfsdf' or 'xyz'), you MUST return status 'error' with message: \"We cannot find this location.\"

            2. **GEOGRAPHY CHECK:** - If valid cities are found, verify if BOTH are inside **INDIA**.
            - If EITHER is outside India (e.g., Paris, London), return status 'error' with message: \"This service only supports travel within India.\"

            3. **FEASIBILITY CHECK (CRITICAL):**
            - Estimate the travel time between the Corrected Origin and Destination.
            - **IF the distance is too long for the given Duration** (e.g., J&K to Kerala in 1 day, or Delhi to Mumbai in 1 day via road), you MUST return status 'error'.
            - **Error Message:** \"Duration is too short for travel between these locations.\"

            4. **ITINERARY GENERATION:**
            - Only if the trip is feasible, generate the itinerary.

            **CONTENT FORMATTING RULES:**
            - **City:** The specific city/town for that day.
            - **Title:** A SINGLE string summarizing activities.
            - **Description:** A detailed paragraph.

            Respond ONLY in this JSON format:

            Success Example:
            {
                \"status\": \"success\",
                \"message\": \"Itinerary generated.\",
                \"corrected_from\": \"Shimla\",
                \"corrected_to\": \"Manali\",
                \"itinerary\": {
                    \"day_1\": { 
                        \"title\": \"Morning Trek to Jakhoo Temple and Evening Walk at The Ridge\", 
                        \"description\": \"Begin your day with a scenic hike...\" 
                    }
                }
            }

            Error Example 1 (Unknown/Gibberish Location):
            {
                \"status\": \"error\",
                \"message\": \"We cannot find this location.\",
                \"corrected_from\": null, 
                \"corrected_to\": null,
                \"itinerary\": {}
            }

            Error Example 2 (Outside India):
            {
                \"status\": \"error\",
                \"message\": \"This service only supports travel within India.\",
                \"corrected_from\": \"New York\", 
                \"corrected_to\": \"London\",
                \"itinerary\": {}
            }

            Error Example (Feasibility/Distance Issue):
            {
                \"status\": \"error\",
                \"message\": \"Duration is too short for travel between these locations.\",
                \"corrected_from\": \"Jammu and Kashmir\", 
                \"corrected_to\": \"Kerala\",
                \"itinerary\": {}
            }

            LOGIC RULES:
            - Return raw JSON only. No markdown.
        ";

        return $prompt;
    }
}
