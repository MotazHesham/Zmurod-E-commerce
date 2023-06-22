<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySellerRequest;
use App\Http\Requests\StoreSellerRequest;
use App\Http\Requests\UpdateSellerRequest;
use App\Models\Seller;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SellersController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('seller_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Seller::with(['user'])->select(sprintf('%s.*', (new Seller)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'seller_show';
                $editGate      = 'seller_edit';
                $deleteGate    = 'seller_delete';
                $crudRoutePart = 'sellers';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('photo', function ($row) {
                if ($photo = $row->photo) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('store_name', function ($row) {
                return $row->store_name ? $row->store_name : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('featured_store', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->featured_store ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'photo', 'user', 'featured_store']);

            return $table->make(true);
        }

        return view('admin.sellers.index');
    }

    public function create()
    {
        abort_if(Gate::denies('seller_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.sellers.create', compact('users'));
    }

    public function store(StoreSellerRequest $request)
    {
        $seller = Seller::create($request->all());

        if ($request->input('photo', false)) {
            $seller->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $seller->id]);
        }

        return redirect()->route('admin.sellers.index');
    }

    public function edit(Seller $seller)
    {
        abort_if(Gate::denies('seller_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $seller->load('user');

        return view('admin.sellers.edit', compact('seller', 'users'));
    }

    public function update(UpdateSellerRequest $request, Seller $seller)
    {
        $seller->update($request->all());

        if ($request->input('photo', false)) {
            if (! $seller->photo || $request->input('photo') !== $seller->photo->file_name) {
                if ($seller->photo) {
                    $seller->photo->delete();
                }
                $seller->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($seller->photo) {
            $seller->photo->delete();
        }

        return redirect()->route('admin.sellers.index');
    }

    public function show(Seller $seller)
    {
        abort_if(Gate::denies('seller_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $seller->load('user');

        return view('admin.sellers.show', compact('seller'));
    }

    public function destroy(Seller $seller)
    {
        abort_if(Gate::denies('seller_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $seller->delete();

        return back();
    }

    public function massDestroy(MassDestroySellerRequest $request)
    {
        $sellers = Seller::find(request('ids'));

        foreach ($sellers as $seller) {
            $seller->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('seller_create') && Gate::denies('seller_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Seller();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
