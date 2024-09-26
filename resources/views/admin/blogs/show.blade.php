@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.blog.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.blogs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.blog.fields.id') }}
                        </th>
                        <td>
                            {{ $blog->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.blog.fields.title') }}
                        </th>
                        <td>
                            {{ $blog->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.blog.fields.content') }}
                        </th>
                        <td>
                            {!! $blog->content !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.blog.fields.short_description') }}
                        </th>
                        <td>
                            {{ $blog->short_description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.blog.fields.photo') }}
                        </th>
                        <td>
                            @if($blog->photo)
                                <a href="{{ $blog->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $blog->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.blog.fields.video') }}
                        </th>
                        <td>
                            @if($blog->video)
                                <a href="{{ $blog->video->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.blog.fields.user') }}
                        </th>
                        <td>
                            {{ $blog->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.blog.fields.media_url') }}
                        </th>
                        <td>
                            {{ $blog->media_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.blog.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Blog::TYPE_SELECT[$blog->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.blog.fields.blog_comments') }}
                        </th>
                        <td>
                            @foreach($blog->blog_comments as $key => $blog_comments)
                                <span class="label label-info">{{ $blog_comments->comment }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            
        </div>
    </div>
</div>



@endsection
