<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumbs = Breadcrumbs::generate('blog.index');

        // 5 bài viết nổi bật (hoặc mới nhất)
        $postsOutstandings = Post::with('author')
            ->latest()
            ->take(5)
            ->get();

        // Các bài viết khác (tuỳ ý thêm phân trang)
        $posts = Post::with('author')
            ->latest()
            ->paginate(10);

        return view('pages.client.blog', [
            'title' => 'Tin tức',
            'posts' => $posts,
            'postsOutstandings' => $postsOutstandings,
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::with('author')->findOrFail($id);

        return view('pages.client.blogDetail', [
            'title' => 'Chi tiết tin tức',
            'post' => $post
        ]);
    }

    /**
     * Show blog posts by category slug (disabled).
     */
    public function showByCategory($slug)
    {
        abort(404);
    }
}
