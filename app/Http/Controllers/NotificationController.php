<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a list of the user's notifications.
     */
    public function index()
    {
        $notifications = Auth::user()->notifications()->paginate(20);
        return view('notifications.index', compact('notifications'));
    }

    /**
     * Get the user's notifications as JSON.
     */
    public function getJsonNotifications()
    {
        $notifications = Auth::user()->notifications()->limit(20)->get();

        // Format the notifications for the frontend
        $formatted = $notifications->map(function ($notif) {
            return [
                'id' => $notif->id,
                'type' => class_basename($notif->type),
                'data' => $notif->data,
                'read_at' => $notif->read_at,
                'is_read' => !is_null($notif->read_at),
                'created_at_human' => $notif->created_at->diffForHumans(null, true, true),
                'avatar' => isset($notif->data['name'])
                    ? "https://ui-avatars.com/api/?name={$notif->data['name']}&background=random"
                    : "https://ui-avatars.com/api/?name=System&background=gray",
            ];
        });

        return response()->json($formatted);
    }

    /**
     * Mark a notification as read.
     */
    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        if (request()->wantsJson()) {
            return response()->json(['status' => 'success']);
        }
        return back();
    }

    /**
     * Mark all of the user's notifications as read.
     */
    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();

        if (request()->wantsJson()) {
            return response()->json(['status' => 'success']);
        }
        return back()->with('success', 'All notifications marked as read.');
    }

    /**
     * Delete a notification.
     */
    public function destroy($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->delete();

        if (request()->wantsJson()) {
            return response()->json(['status' => 'success']);
        }
        return back()->with('success', 'Notification deleted.');
    }
}
