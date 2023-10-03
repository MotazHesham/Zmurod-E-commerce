<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('media', 'user', 'tags')->paginate(9);

        return view('frontend.blogs.blog', compact('blogs'));
    }
    public function show($id)
    {
        $blog = Blog::find($id);
        $blog->load('media', 'user', 'tags', 'blog_comments.user_comments');

        return view('frontend.blogs.singleblog', compact('blog'));
    }
    public function storeBlogComment(Request $request)
    {
        $data = $request->validate([
            'user_comment' => 'required',
            'comment' => 'required',
        ]);

        // Create a comment
        $comment = Comment::create([
            'comment' => $data['comment'],
            'comment_for' => 'Blog-comment',
        ]);

        // Attach user comment relationship
        $comment->user_comments()->attach([
            auth()->user()->id => ['comment_id' => $comment->id],
        ]);

        // Save the comment
        $comment->save();

        // Find the blog
        $blog = Blog::find($request->id);

        // Attach the comment to the blog
        $blog->blog_comments()->attach($comment);
        Alert::success('You commented successfully to this blog');
        return redirect()->back();
    }
}
