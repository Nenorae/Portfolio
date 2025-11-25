<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // index() GET: List notifikasi user
    public function index()
    {
        // Mengambil notifikasi milik user yang sedang login
        $notifications = Auth::user()->notifications()->paginate(20);
        
        return view('notifications.index', compact('notifications'));
    }

    // markAsRead(Notification $notification) POST: Tandai dibaca
    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        return back();
    }

    // markAllAsRead() POST: Tandai semua dibaca
    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();

        return back()->with('success', 'All notifications marked as read.');
    }

    // destroy(Notification $notification) DELETE: Hapus notifikasi
    public function destroy($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->delete();

        return back()->with('success', 'Notification deleted.');
    }
}


//
// Tugas:
// - Menampilkan notifikasi
// - Menandai sebagai sudah dibaca
// - Menghapus notifikasi
//
// Methods:
// - index() GET: List notifikasi user
// - markAsRead(Notification \$notification) POST: Tandai dibaca
// - markAllAsRead() POST: Tandai semua dibaca
// - destroy(Notification \$notification) DELETE: Hapus notifikasi
//

