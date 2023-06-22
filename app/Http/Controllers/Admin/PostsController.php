<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPostRequest;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Comment;
use App\Models\Froum;
use App\Models\Post;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('post_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $posts = Post::with(['post_forum', 'author', 'post_comments'])->get();

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        abort_if(Gate::denies('post_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $post_forums = Froum::pluck('category', 'id')->prepend(trans('global.pleaseSelect'), '');

        $authors = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $post_comments = Comment::pluck('comment', 'id');

        return view('admin.posts.create', compact('authors', 'post_comments', 'post_forums'));
    }

    public function store(StorePostRequest $request)
    {
        $post = Post::create($request->all());
        $post->post_comments()->sync($request->input('post_comments', []));

        return redirect()->route('admin.posts.index');
    }

    public function edit(Post $post)
    {
        abort_if(Gate::denies('post_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $post_forums = Froum::pluck('category', 'id')->prepend(trans('global.pleaseSelect'), '');

        $authors = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $post_comments = Comment::pluck('comment', 'id');

        $post->load('post_forum', 'author', 'post_comments');

        return view('admin.posts.edit', compact('authors', 'post', 'post_comments', 'post_forums'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->all());
        $post->post_comments()->sync($request->input('post_comments', []));

        return redirect()->route('admin.posts.index');
    }

    public function show(Post $post)
    {
        abort_if(Gate::denies('post_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $post->load('post_forum', 'author', 'post_comments');

        return view('admin.posts.show', compact('post'));
    }

    public function destroy(Post $post)
    {
        abort_if(Gate::denies('post_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $post->delete();

        return back();
    }

    public function massDestroy(MassDestroyPostRequest $request)
    {
        $posts = Post::find(request('ids'));

        foreach ($posts as $post) {
            $post->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
