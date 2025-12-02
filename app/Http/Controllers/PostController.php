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
     * Display a gallery of all posts.
     */
    public function index(Request $request)
    {
        $posts = Post::withUser()           
                    ->withLikesCount()      
                    ->latest()              
                    ->paginate(12);

        if ($request->ajax()) {
            return view('posts._post-cards', compact('posts'))->render();
        }
        
        return view('posts.index', compact('posts'));
    }

    /**
     * Display a feed of posts from users the current user follows.
     */
    public function feed(Request $request)
    {
        $posts = Post::fromFollowing(auth()->id()) 
                    ->withUser()
                    ->withLikesCount()
                    ->latest()
                    ->paginate(12);
        
        if ($request->ajax()) {
            return view('posts._post-cards', compact('posts'))->render();
        }

        return view('posts.feed', compact('posts'));
    }
  
    /**
     * Show the form for creating a new post.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created post in storage.
     */
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

    /**
     * Display the specified post.
     */
    public function show(Post $post)
    {
        $post = Post::where('id', $post->id)
                    ->withUser()
                    ->withLikesCount()
                    ->first();
        
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified post.
     */
    public function edit(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified post in storage.
     */
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

    /**
     * Remove the specified post from storage.
     */
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

    /**
     * Like a post.
     */
    public function like(Post $post)
    {
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

    /**
     * Unlike a post.
     */
    public function unlike(Post $post)
    {
        $post->likes()->where('user_id', Auth::id())->delete();

        return response()->json([
            'liked' => false,
            'likes_count' => $post->likes()->count()
        ]);
    }
}
