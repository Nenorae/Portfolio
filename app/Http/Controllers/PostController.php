<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//
// Tugas:
// - Menampilkan feed (timeline)
// - Membuat post baru
// - Menampilkan detail post
// - Mengedit post
// - Menghapus post
// - Upload gambar post
//
// Methods:
// - index() GET: Feed/timeline (posts dari user yang di-follow)
// - create() GET: Form buat post baru
// - store(StorePostRequest \$request) POST: Simpan post
// - show(Post \$post) GET: Detail post
// - edit(Post \$post) GET: Form edit post
// - update(Request \$request, Post \$post) PUT: Update post
// - destroy(Post \$post) DELETE: Hapus post
//
class PostController extends Controller
{
    //
}
