<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * index() GET: Menampilkan SEMUA karya (gallery explore)
     * Mendukung Infinite Scroll melalui pengecekan AJAX.
     */
    public function index(Request $request)
    {
        // Ambil data dengan pagination
        $posts = Post::withUser()           
                    ->withLikesCount()      
                    ->latest()              
                    ->paginate(12);

        // Jika permintaan adalah AJAX, kembalikan hanya partial card untuk Infinite Scroll
        if ($request->ajax()) {
            return view('posts._post-cards', compact('posts'))->render();
        }
        
        // Jika permintaan normal, kembalikan view penuh
        return view('posts.index', compact('posts'));
    }

    /**
     * feed() GET: Menampilkan timeline/feed (post dari user yang di-follow)
     * Mendukung Infinite Scroll melalui pengecekan AJAX.
     */
    public function feed(Request $request)
    {
        // Ambil data dengan pagination
        $posts = Post::fromFollowing(auth()->id()) 
                    ->withUser()
                    ->withLikesCount()
                    ->latest()
                    ->paginate(12);
        
        // Jika permintaan adalah AJAX, kembalikan hanya partial card untuk Infinite Scroll
        if ($request->ajax()) {
            // Catatan: Anda mungkin perlu membuat partial terpisah seperti '_feed-cards.blade.php' 
            // jika tampilan feed berbeda dengan explore, namun untuk kemudahan, 
            // kita asumsikan menggunakan partial yang sama untuk saat ini.
            return view('posts._post-cards', compact('posts'))->render();
        }

        return view('posts.feed', compact('posts'));
    }
  
    // create() GET: Form buat post baru
    public function create()
    {
        return view('posts.create');
    }

    // store(StorePostRequest $request) POST: Simpan post
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            $validated['image'] = $path;
        }

        $validated['user_id'] = Auth::id();

        Post::create($validated);

        return redirect()->route('posts.index')->with('success', 'Karya berhasil diupload!');
    }

    // show(Post $post) GET: Detail post
    public function show(Post $post)
    {
        // Memuat relasi user dan likes count untuk detail
        // Karena $post sudah berupa instance model, kita tidak bisa chaining scopes.
        // Kita buat query baru menggunakan ID post yang sudah ter-resolve, lalu terapkan scopes.
        $post = Post::where('id', $post->id)
                    ->withUser()
                    ->withLikesCount()
                    ->first();
        
        // Catatan: Pastikan scopes withUser() dan withLikesCount() didefinisikan 
        // dengan benar di model Post.

        return view('posts.show', compact('post'));
    }

    // edit(Post $post) GET: Form edit post
    public function edit(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        return view('posts.edit', compact('post'));
    }

    // update(Request $request, Post $post) PUT: Update post
    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'caption' => 'required|string',
            'github_link' => 'nullable|url',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $validated['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($validated);

        return redirect()->route('posts.show', $post)->with('success', 'Karya berhasil diupdate!');
    }

    // destroy(Post $post) DELETE: Hapus post
    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Karya berhasil dihapus!');
    }

    // ... method lainnya ...

    // LOGIKA LIKE (DIPERBAIKI)
    public function like(Post $post)
    {
        // Cek duplikasi biar gak bisa like 2x
        $existingLike = $post->likes()->where('user_id', Auth::id())->first();

        if (!$existingLike) {
            $post->likes()->create([
                'user_id' => Auth::id()
            ]);
        }

        return response()->json([
            'liked' => true,
            'likes_count' => $post->likes()->count()
        ]);
    }

    // LOGIKA UNLIKE (DIPERBAIKI)
    public function unlike(Post $post)
    {
        $post->likes()->where('user_id', Auth::id())->delete();

        return response()->json([
            'liked' => false,
            'likes_count' => $post->likes()->count()
        ]);
    }
}

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
