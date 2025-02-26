<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SFTPController extends Controller
{
    public function downloadFile()
    {
        // $filename = '1000017947.txt'; // Replace with the filename you want to download

        // // Check if the file exists on the SFTP server
        // if (Storage::disk('sftp')->exists($filename)) {
        //     // The file exists, now download it
        //     $fileContents = Storage::disk('sftp')->get($filename);

        //     // You can either return it as a response or save it locally
        //     return response($fileContents, 200, [
        //         'Content-Type' => 'text/plain', // Adjust the content type as needed
        //         'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        //     ]);
        // } else {
        //     return response()->json(['error' => 'File not found on SFTP server'], 404);
        // }

        $filename = '1000017947.csv';
        if (Storage::disk('sftp')->exists($filename)) {

            $fileContents = Storage::disk('sftp')->get($filename);

            $localPath = $filename;

            Storage::disk('public')->put($localPath, $fileContents);

            return response()->json(['message' => 'File downloaded successfully to public folder!'], 200);
        } else {
            return response()->json(['error' => 'File not found on SFTP server'], 404);
        }
    }

    public function checkSftpConnection()
    {
        try {
            // Attempt to list files from the SFTP server
            $files = Storage::disk('sftp')->files('/'); // Try listing files in the root directory

            return response()->json(['files' => $files], 200); // Return the list of files
        } catch (\Exception $e) {
            // If the connection fails, catch the error and return it
            return response()->json(['error' => 'Unable to connect to SFTP server: ' . $e->getMessage()], 500);
        }
    }
}
