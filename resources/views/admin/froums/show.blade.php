@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.froum.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.froums.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.froum.fields.id') }}
                            </th>
                            <td>
                                {{ $froum->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.froum.fields.name') }}
                            </th>
                            <td>
                                {{ $froum->name }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.froums.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            {{ trans('global.relatedData') }}
        </div>
        <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
            <li class="nav-item">
                <a class="nav-link" href="#post_forum_posts" role="tab" data-toggle="tab">
                    {{ trans('cruds.post.title') }}
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" role="tabpanel" id="post_forum_posts">
                @includeIf('admin.froums.relationships.postForumPosts', ['posts' => $froum->postForumPosts])
            </div>
        </div>
    </div>
@endsection
