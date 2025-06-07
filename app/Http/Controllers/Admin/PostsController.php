<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Post::with('author');

        if ($search) {
            $query->where('title', 'like', "%{$search}%");
        }

        $posts = $query->paginate(10);

        return view('pages.admin.posts.index', [
            'title' => 'Danh sách tin tức',
            'posts' => $posts,
        ]);
    }

    public function create()
    {
        $authors = User::where('role', 1)->pluck('name', 'id');

        return view('pages.admin.posts.add', [
            'title' => "Thêm tin tức",
            'authors' => $authors,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255|unique:posts,title',
            'slug' => 'nullable|max:255|unique:posts,slug',
            'user_id' => 'required|exists:users,id',
            'content' => 'required',
            'description' => 'required',
            'image' => 'required|image',
            'status' => 'required|in:0,1',
        ]);

        // Upload image
        $imagePath = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $imagePath = $imageName;
        }

        // Create post
        Post::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'user_id' => $request->user_id,
            'content' => $request->content,
            'description' => $request->description,
            'image' => $imagePath,
            'status' => $request->status,
        ]);

        return redirect()->route('post.index')->with('success', 'Tin tức đã được thêm thành công.');
    }

    public function show($id)
    {
        $post = Post::with('author')->findOrFail($id);

        return view('pages.admin.posts.detail', [
            'title' => 'Chi tiết tin tức',
            'post' => $post,
        ]);
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $authors = User::where('role', 1)->pluck('name', 'id');

        return view('pages.admin.posts.edit', [
            'title' => 'Chỉnh sửa tin tức',
            'post' => $post,
            'authors' => $authors,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|max:255|unique:posts,slug,' . $id,
            'user_id' => 'required|exists:users,id',
            'content' => 'required',
            'description' => 'required',
            'image' => 'nullable|image',
            'status' => 'required|in:0,1',
        ]);

        $post = Post::findOrFail($id);

        // Update image if exists
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $post->image = $imageName;
        }

        // Update post fields
        $post->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'user_id' => $request->user_id,
            'content' => $request->content,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('post.index')->with('success', 'Tin tức đã được cập nhật thành công.');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('post.index')->with('success', 'Xóa tin tức thành công.');
    }

    public function togglepostStatus(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->status = $request->input('status');
        $post->save();

        return response()->json(['status' => $post->status]);
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');
        Post::whereIn('id', $ids)->each(function ($post) {
            $post->delete();
        });

        return response()->json(['success' => true]);
    }
}
