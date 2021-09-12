<?php

namespace App\Http\Controllers;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications->map(function ($item) {
            return [
                'message' => $item['data']['message'],
                'target_url' => $item['data']['target_url'],
                'read' => $item['read_at'] !== null,
                'created_at' => $item['created_at']->format('M d, Y H:i'),
            ];
        });

        return response()->json($notifications);
    }
}
