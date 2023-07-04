<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyFroumRequest;
use App\Http\Requests\StoreFroumRequest;
use App\Http\Requests\UpdateFroumRequest;
use App\Models\Froum;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class FroumsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('froum_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $froums = Froum::all();

        return view('admin.froums.index', compact('froums'));
    }

    public function create()
    {
        abort_if(Gate::denies('froum_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.froums.create');
    }

    public function store(StoreFroumRequest $request)
    {
        $froum = Froum::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $froum->id]);
        }
        alert()->success(trans('flash.store.title'),trans('flash.store.body'));
        return redirect()->route('admin.froums.index');
    }

    public function edit(Froum $froum)
    {
        abort_if(Gate::denies('froum_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.froums.edit', compact('froum'));
    }

    public function update(UpdateFroumRequest $request, Froum $froum)
    {
        $froum->update($request->all());
        alert()->success(trans('flash.update.title'),trans('flash.update.body'));
        return redirect()->route('admin.froums.index');
    }

    public function show(Froum $froum)
    {
        abort_if(Gate::denies('froum_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.froums.show', compact('froum'));
    }

    public function destroy(Froum $froum)
    {
        abort_if(Gate::denies('froum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $froum->delete();
        alert()->success(trans('flash.destroy.title'),trans('flash.destroy.body'));
        return back();
    }

    public function massDestroy(MassDestroyFroumRequest $request)
    {
        $froums = Froum::find(request('ids'));

        foreach ($froums as $froum) {
            $froum->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('froum_create') && Gate::denies('froum_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Froum();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
