<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySellerRequest;
use App\Http\Requests\StoreSellerRequest;
use App\Http\Requests\UpdateSellerRequest;
use App\Models\Brand;
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

    public function update_statuses(Request $request)
    {
        $column_name = $request->column_name;
        $seller = Seller::find($request->id);
        $seller->$column_name = $request->featured_store;
        $seller->save();
        return 1;
    }
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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->user->name : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->user->email : '';
            });
            $table->editColumn('country', function ($row) {
                return $row->country ? $row->user->country : '';
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->user->phone : '';
            });
            $table->editColumn('store_name', function ($row) {
                return $row->store_name ? $row->store_name : '';
            });
            $table->editColumn('featured_store', function ($row) {
                return  ' <label class="c-switch c-switch-pill c-switch-success">
                            <input onchange="update_statuses(this,\'featured_store\')" value="' . $row->id . '" 
                                type="checkbox" class="c-switch-input" ' . ($row->featured_store ? "checked" : null) . '>
                            <span class="c-switch-slider"></span>
                        </label>';
            });


            $table->rawColumns(['actions', 'placeholder', 'photo', 'user', 'featured_store', 'brand_name']);

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
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_type' => 'seller',
            'country' => $request->country,
            'phone' => $request->phone
        ]);

        $validated_request = $request->all();
        $validated_request['user_id'] = $user->id;
        $seller = Seller::create($validated_request);

        if ($request->input('photo', false)) {
            $seller->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $seller->id]);
        }
        alert()->success(trans('flash.store.title'), trans('flash.store.body'));
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

        $user = User::find($seller->user_id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password != null ? bcrypt($request->password) : $user->password,
            'country' => $request->country,
            'phone' => $request->phone
        ]);

        if ($request->input('photo', false)) {
            if (!$seller->photo || $request->input('photo') !== $seller->photo->file_name) {
                if ($seller->photo) {
                    $seller->photo->delete();
                }
                $seller->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($seller->photo) {
            $seller->photo->delete();
        }
        alert()->success(trans('flash.update.title'), trans('flash.update.body'));
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
        alert()->success(trans('flash.destroy.title'), trans('flash.destroy.body'));
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
