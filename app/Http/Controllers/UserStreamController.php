<?php

// namespace App\Http\Controllers;

// use App\Models\User;
// use Illuminate\Http\Request;

// class UserStreamController extends Controller
// {
//     public function stream()
//     {
//         return response()->stream(function () {
//             User::chunk(100, function ($users) {
//                 foreach ($users as $user) {
//                     echo json_encode([
//                         'id'    => $user->id,
//                         'name'  => $user->name,
//                         'email' => $user->email,
//                     ]) . "\n";
//                     ob_flush();
//                     flush();
//                 }
//             });
//         }, 200, [
//             'Content-Type'      => 'application/json',
//             'Cache-Control'     => 'no-cache',
//             'X-Accel-Buffering' => 'no',
//         ]);
//     }
// }


namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserStreamController extends Controller
{
    public function stream()
    {
        return response()->stream(function () {
            // Turn off all output buffering
            while (ob_get_level() > 0) {
                ob_end_flush();
            }

            User::chunk(100, function ($users) {
                foreach ($users as $user) {
                    // SSE format: data: <payload>\n\n
                    echo "data: " . json_encode([
                        'id'    => $user->id,
                        'name'  => $user->name,
                        'email' => $user->email,
                    ]) . "\n\n";

                    flush();
                    usleep(1000); 
                }
            });

            echo "event: end\n";
            echo "data: Stream finished\n\n";
            flush();

        }, 200, [
            'Content-Type'      => 'text/event-stream',
            'Cache-Control'     => 'no-cache',
            'X-Accel-Buffering' => 'no',
            'Connection'        => 'keep-alive',
        ]);
    }
}
