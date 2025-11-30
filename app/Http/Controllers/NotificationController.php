<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // index() GET: Halaman full list (opsional, fallback jika JS gagal)
    public function index()
    {
        $notifications = Auth::user()->notifications()->paginate(20);
        return view('notifications.index', compact('notifications'));
    }

    // [BARU] API untuk Drawer (Alpine.js)
    public function getJsonNotifications()
    {
        // Ambil notifikasi user
        $notifications = Auth::user()->notifications()->limit(20)->get();

        // Format data agar siap pakai di Frontend
        $formatted = $notifications->map(function ($notif) {
            return [
                'id' => $notif->id,
                'type' => class_basename($notif->type), // Misal: PostLiked, UserFollowed
                'data' => $notif->data, // Isi pesan notif
                'read_at' => $notif->read_at,
                'is_read' => !is_null($notif->read_at),
                'created_at_human' => $notif->created_at->diffForHumans(null, true, true), // "2m", "1h"

                // Avatar Logic: 
                // Asumsi di data notifikasi kamu menyimpan 'user_name' atau 'user_id'
                // Jika tidak ada, pakai default sistem
                'avatar' => isset($notif->data['name'])
                    ? "https://ui-avatars.com/api/?name={$notif->data['name']}&background=random"
                    : "https://ui-avatars.com/api/?name=System&background=gray",
            ];
        });

        return response()->json($formatted);
    }

    // [UPDATE] Mark As Read via API
    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        // Return JSON jika request dari AJAX, redirect jika dari browser biasa
        if (request()->wantsJson()) {
            return response()->json(['status' => 'success']);
        }
        return back();
    }

    // markAllAsRead() POST: Tandai semua dibaca
    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();

        if (request()->wantsJson()) {
            return response()->json(['status' => 'success']);
        }
        return back()->with('success', 'All notifications marked as read.');
    }

    // destroy(Notification $notification) DELETE: Hapus notifikasi
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
