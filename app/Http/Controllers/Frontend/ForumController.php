<?php

namespace App\Http\Controllers\Frontend;

use App\Events\CommentAdded;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Froum;
use App\Models\Post;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ForumController extends Controller
{
   public function index()
   {
      // get all forums 
      $forums = Froum::with('postForumPosts')->get();
      // get latest post from each forum
      $posts = Post::where('publish', true)->with('author', 'post_comments', 'post_tags', 'post_forum.postForumPosts')->get();
      return view('frontend.forums.forum', compact('forums', 'posts'));
   }

   public function show($id)
   {
      // single post
      $post = Post::with('author', 'post_comments.user_comments', 'post_tags', 'post_forum.postForumPosts')->find($id);
      $forums = Froum::with('postForumPosts')->get();
      return view('frontend.forums.post', compact('post', 'forums'));
   }

   public function comment(Request $request)
   {

      // Validate the comment
      $data = $request->validate([
         'comment' => 'required|regex:/^[\p{Arabic}\p{L}\d\s]{3,200}$/u',
         'post_id' => 'required',
         'user_name' => 'required',
      ]);

      // Create Comment
      $comment = Comment::create([
         'comment' => $data['comment'],
         'comment_for' => 'Forum-comment',
      ]);
      // Associate the comment with the authenticated user
      $comment->user_comments()->attach([
         auth()->user()->id => ['comment_id' => $comment->id],
      ]);
      // Construct the data to be sent in the Pusher event
      $data = [
         'from' => auth()->user()->id,
         'comment' => [
            'user_comment' => $data['user_name'],
            'comment' => $data['comment'],
            'created_at' => $comment->created_at->format(config('panel.date_format')),
         ],

      ];
      // Dispatch the Pusher event
      event(new CommentAdded($comment, $data));

      // Associate the comment with the post
      $post = Post::with('post_comments')->findOrFail($request->post_id);
      $post->post_comments()->attach($comment);


      // Return the same page with the new comment
      return response()->json(['message' => 'Comment added successfully', 'data' => $data]);
   }
}
