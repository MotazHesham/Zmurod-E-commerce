<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBannerRequest;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use App\Models\Banner;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class BannerController extends Controller
{
    use MediaUploadingTrait;

    function update_statuses(Request $request) {
        $column_name = $request->column_name;
        $banner = Banner::find($request->id);
        $banner->$column_name= $request->active;
        $banner->save();
        return 1 ; 
    }

    public function index()
    {
        abort_if(Gate::denies('banner_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $banners = Banner::with(['media'])->get();

        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        abort_if(Gate::denies('banner_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.banners.create');
    }

    public function store(StoreBannerRequest $request)
    {
        $banner = Banner::create($request->all());

        foreach ($request->input('banner_photo', []) as $file) {
            $banner->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('banner_photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $banner->id]);
        }
        alert()->success(trans('flash.store.title'),trans('flash.store.body'));
        return redirect()->route('admin.banners.index');
    }

    public function edit(Banner $banner)
    {
        abort_if(Gate::denies('banner_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.banners.edit', compact('banner'));
    }

    public function update(UpdateBannerRequest $request, Banner $banner)
    {
        $banner->update($request->all());

        if (count($banner->banner_photo) > 0) {
            foreach ($banner->banner_photo as $media) {
                if (! in_array($media->file_name, $request->input('banner_photo', []))) {
                    $media->delete();
                }
            }
        }
        $media = $banner->banner_photo->pluck('file_name')->toArray();
        foreach ($request->input('banner_photo', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $banner->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('banner_photo');
            }
        }
        alert()->success(trans('flash.update.title'),trans('flash.update.body'));
        return redirect()->route('admin.banners.index');
    }

    public function show(Banner $banner)
    {
        abort_if(Gate::denies('banner_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.banners.show', compact('banner'));
    }

    public function destroy(Banner $banner)
    {
        abort_if(Gate::denies('banner_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $banner->delete();
        alert()->success(trans('flash.destroy.title'),trans('flash.destroy.body'));
        return back();
    }

    public function massDestroy(MassDestroyBannerRequest $request)
    {
        $banners = Banner::find(request('ids'));

        foreach ($banners as $banner) {
            $banner->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('banner_create') && Gate::denies('banner_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Banner();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
