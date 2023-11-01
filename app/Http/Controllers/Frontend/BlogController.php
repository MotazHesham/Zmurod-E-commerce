<?php

namespace App\Http\Controllers\Frontend;

use App\Events\CommentAdded;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Pusher\Pusher;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('media', 'user', 'tags')->paginate(9);

        return view('frontend.blogs.index', compact('blogs'));
    }
    public function show($id)
    {
        $blog = Blog::find($id);
        $blog->load('media', 'user', 'tags', 'blog_comments.user_comments');

        return view('frontend.blogs.show', compact('blog'));
    }
    public function storeComment(Request $request)
    {

        // Create a comment
        $comment = Comment::create([
            'comment' => $request->comment,
            'comment_for' => 'Blog-comment',
        ]);

        // Attach user comment relationship
        $comment->user_comments()->attach([
            auth()->user()->id => ['comment_id' => $comment->id],
        ]);

        // Construct the data to be sent in the Pusher event
        $data = [
            'from' => auth()->user()->id,
            'comment' => [
                'user_comment' => $request->user_comment,
                'comment' => $request->comment,
            ],

        ];

        // Dispatch the Pusher event
        event(new CommentAdded($comment, $data));

        // Attach the comment to the blog
        $blog = Blog::with('blog_comments.user_comments')->find($request->id);
        $blog->blog_comments()->attach($comment);

        // Return the same page with the new comment
        return response()->json(['message' => 'Comment added successfully', 'data' => $data]);
    }
}
