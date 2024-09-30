@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.comment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.comments.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="comment">{{ trans('cruds.comment.fields.comment') }}</label>
                <textarea class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}" name="comment" id="comment" required>{{ old('comment') }}</textarea>
                @if($errors->has('comment'))
                    <div class="invalid-feedback">
                        {{ $errors->first('comment') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.comment_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_comments">{{ trans('cruds.comment.fields.user_comment') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('user_comments') ? 'is-invalid' : '' }}" name="user_comments[]" id="user_comments" multiple>
                    @foreach($user_comments as $id => $user_comment)
                        <option value="{{ $id }}" {{ in_array($id, old('user_comments', [])) ? 'selected' : '' }}>{{ $user_comment }}</option>
                    @endforeach
                </select>
                @if($errors->has('user_comments'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user_comments') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.user_comment_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.comment.fields.comment_for') }}</label>
                <select class="form-control {{ $errors->has('comment_for') ? 'is-invalid' : '' }}" name="comment_for" id="comment_for" required>
                    <option value disabled {{ old('comment_for', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Comment::COMMENT_FOR_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('comment_for', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('comment_for'))
                    <div class="invalid-feedback">
                        {{ $errors->first('comment_for') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.comment_for_helper') }}</span>
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
