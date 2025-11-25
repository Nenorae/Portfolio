<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//
// Tugas:
// - Mengelola notifikasi follow & like
// - Scope unread
//
// Relasi:
// - user() belongsTo User (penerima)
// - actor() belongsTo User (pelaku aksi)
// - post() belongsTo Post (untuk notifikasi like)
//
// Methods:
// - markAsRead() Tandai sudah dibaca
// - scopeUnread($query) Filter notifikasi belum dibaca
//
class Notification extends Model
{
    //
}
