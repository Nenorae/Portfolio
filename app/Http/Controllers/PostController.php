<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest; // Pastikan file request ini ada
use App\Http\Requests\UpdatePostRequest; // Pastikan file request ini ada
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // index() GET: Feed/timeline (posts dari user yang di-follow)
    public function index()
    {
        // Ambil ID user yang diikuti oleh user yang sedang login
        $followingIds = Auth::user()->following()->pluck('users.id');

        // Tampilkan post dari user yang diikuti DAN post sendiri
        $posts = Post::whereIn('user_id', $followingIds)
                    ->orWhere('user_id', Auth::id())
                    ->with('user') // Eager load user data
                    ->latest()
                    ->paginate(10);

        return view('posts.index', compact('posts'));
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

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    // show(Post $post) GET: Detail post
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // edit(Post $post) GET: Form edit post
    public function edit(Post $post)
    {
        // Pastikan hanya pemilik yang bisa edit
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
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $validated['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($validated);

        return redirect()->route('posts.show', $post)->with('success', 'Post updated!');
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

        return redirect()->route('posts.index')->with('success', 'Post deleted!');
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
