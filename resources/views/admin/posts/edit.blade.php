@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.post.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.posts.update", [$post->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.post.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $post->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.post.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="content">{{ trans('cruds.post.fields.content') }}</label>
                <textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content" id="content" required>{{ old('content', $post->content) }}</textarea>
                @if($errors->has('content'))
                    <div class="invalid-feedback">
                        {{ $errors->first('content') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.post.fields.content_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="post_forum_id">{{ trans('cruds.post.fields.post_forum') }}</label>
                <select class="form-control select2 {{ $errors->has('post_forum') ? 'is-invalid' : '' }}" name="post_forum_id" id="post_forum_id" required>
                    @foreach($post_forums as $id => $entry)
                        <option value="{{ $id }}" {{ (old('post_forum_id') ? old('post_forum_id') : $post->post_forum->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('post_forum'))
                    <div class="invalid-feedback">
                        {{ $errors->first('post_forum') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.post.fields.post_forum_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="author_id">{{ trans('cruds.post.fields.author') }}</label>
                <select class="form-control select2 {{ $errors->has('author') ? 'is-invalid' : '' }}" name="author_id" id="author_id" required>
                    @foreach($authors as $id => $entry)
                        <option value="{{ $id }}" {{ (old('author_id') ? old('author_id') : $post->author->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('author'))
                    <div class="invalid-feedback">
                        {{ $errors->first('author') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.post.fields.author_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="post_comments">{{ trans('cruds.post.fields.post_comments') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('post_comments') ? 'is-invalid' : '' }}" name="post_comments[]" id="post_comments" multiple>
                    @foreach($post_comments as $id => $post_comment)
                        <option value="{{ $id }}" {{ (in_array($id, old('post_comments', [])) || $post->post_comments->contains($id)) ? 'selected' : '' }}>{{ $post_comment }}</option>
                    @endforeach
                </select>
                @if($errors->has('post_comments'))
                    <div class="invalid-feedback">
                        {{ $errors->first('post_comments') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.post.fields.post_comments_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection