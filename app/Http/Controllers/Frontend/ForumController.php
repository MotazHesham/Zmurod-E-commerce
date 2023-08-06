<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Froum;
use App\Models\Post;
use Illuminate\Http\Request;

class ForumController extends Controller
{
   public function index() 
   {
   // get all forums 
   $forums = Froum::all();
   // get latest post from each forum
   $posts = Post::with('post_comments','post_forum')->get();
   return view('frontend.forum',compact('forums','posts'));
   }

   public function show($id) 
   {
   // single post
   $post = Post::with('author','post_comments','post_tags','post_forum')->find($id);
   $forums = Froum::all();
   return view('frontend.post',compact('post','forums'));
   }
}
