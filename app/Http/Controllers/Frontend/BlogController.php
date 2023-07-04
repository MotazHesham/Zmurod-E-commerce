<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    function index() {
        $blogs = Blog::all();

        return view('frontend.blog',compact('blogs'));
    }
    function show($id) {
        $blog= Blog::find($id);
        $comments = Comment::all();
        return view('frontend.singleblog', compact('blog','comments')) ;
    }
}
