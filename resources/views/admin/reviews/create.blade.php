@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.review.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.reviews.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="rating">{{ trans('cruds.review.fields.rating') }}</label>
                <input class="form-control {{ $errors->has('rating') ? 'is-invalid' : '' }}" type="number" name="rating" id="rating" value="{{ old('rating', '') }}" step="0.01" required>
                @if($errors->has('rating'))
                    <div class="invalid-feedback">
                        {{ $errors->first('rating') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.rating_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="comment">{{ trans('cruds.review.fields.comment') }}</label>
                <input class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}" type="text" name="comment" id="comment" value="{{ old('comment', '') }}" required>
                @if($errors->has('comment'))
                    <div class="invalid-feedback">
                        {{ $errors->first('comment') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.comment_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('published') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="published" id="published" value="1" required {{ old('published', 0) == 1 || old('published') === null ? 'checked' : '' }}>
                    <label class="required form-check-label" for="published">{{ trans('cruds.review.fields.published') }}</label>
                </div>
                @if($errors->has('published'))
                    <div class="invalid-feedback">
                        {{ $errors->first('published') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.published_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_review_id">{{ trans('cruds.review.fields.user_review') }}</label>
                <select class="form-control select2 {{ $errors->has('user_review') ? 'is-invalid' : '' }}" name="user_review_id" id="user_review_id" required>
                    @foreach($user_reviews as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_review_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user_review'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user_review') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.user_review_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="product_review_id">{{ trans('cruds.review.fields.product_review') }}</label>
                <select class="form-control select2 {{ $errors->has('product_review') ? 'is-invalid' : '' }}" name="product_review_id" id="product_review_id" required>
                    @foreach($product_reviews as $id => $entry)
                        <option value="{{ $id }}" {{ old('product_review_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('product_review'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product_review') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.product_review_helper') }}</span>
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