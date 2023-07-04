<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Froum;
use App\Models\Post;
use Illuminate\Http\Request;

class ForumController extends Controller
{
   function index() {
    $forums = Froum::all();
    $posts = Post::all();
    return view('frontend.forum',compact('forums','posts'));
   }
   function show($id) {
    $post = Post::find($id);
    $comments = $post->post_comments()->get();
    return view('frontend.post',compact('post' , 'comments'));
   }
}
