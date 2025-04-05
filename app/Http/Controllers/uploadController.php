<?php

namespace App\Http\Controllers;

use getID3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function create()
    {
        return view("upload.create");
    }

    public function store(Request $request)
    {
        // Validate file
        $request->validate([
            'video' => 'required|mimes:mp4,avi,mkv|max:25600',
        ]);

        $video = $request->file('video');
        $path = $video->store('public/videos');

        $videoPath = Storage::disk('local')->path($path);

        if (!file_exists($videoPath)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        $getID3 = new getID3();
        $fileInfo = $getID3->analyze($videoPath);

        $duration = $fileInfo['playtime_seconds'] ?? null;
    
        return response()->json([
            'duration' => $duration ? gmdate("H:i:s", $duration) : 'Unknown',
        ]);
    }
}
