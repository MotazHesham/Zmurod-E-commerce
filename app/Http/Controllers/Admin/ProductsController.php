<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Tag;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProductsController extends Controller
{
    use MediaUploadingTrait;

    public function update_statuses(Request $request)
    {
        $column_name = $request->column_name;
        $product = Product::find($request->id);
        $product->$column_name = $request->status;
        $product->save();
        return 1;
    }

    public function index(Request $request)
    {
        abort_if(Gate::denies('product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Product::with(['product_tags', 'product_category', 'user', 'product_offers'])->select(sprintf('%s.*', (new Product)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'product_show';
                $editGate = 'product_edit';
                $deleteGate = 'product_delete';
                $crudRoutePart = 'products';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('current_stock', function ($row) {
                return $row->current_stock ? $row->current_stock : '';
            });
            $table->editColumn('most_recent', function ($row) {
                return ' <label class="c-switch c-switch-pill c-switch-success">
                <input onchange="update_statuses(this,\'most_recent\')" value="' . $row->id . '" 
                    type="checkbox" class="c-switch-input" ' . ($row->most_recent ? "checked" : null) . '>
                <span class="c-switch-slider"></span>
            </label>';
            });
            $table->editColumn('discount', function ($row) {
                return $row->discount ? $row->discount : '';
            });
            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : '';
            });
            $table->editColumn('image', function ($row) {
                if (!$row->image) {
                    return '';
                }
                $links = [];
                foreach ($row->image as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });
            $table->editColumn('product_tags', function ($row) {
                $labels = [];
                foreach ($row->product_tags as $product_tag) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $product_tag->name);
                }

                return implode(' ', $labels);
            });
            $table->addColumn('product_category_name', function ($row) {
                return $row->product_category ? $row->product_category->name : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('fav', function ($row) {
                return ' <label class="c-switch c-switch-pill c-switch-success">
                    <input onchange="update_statuses(this,\'fav\')" value="' . $row->id . '" type="checkbox" class="c-switch-input" ' . ($row->fav ? "checked" : null) . '>
                    <span class="c-switch-slider"></span>
                </label>';

            });
            $table->editColumn('published', function ($row) {
                return ' <label class="c-switch c-switch-pill c-switch-success">
                    <input onchange="update_statuses(this,\'published\')" value="' . $row->id . '" type="checkbox" class="c-switch-input" ' . ($row->published ? "checked" : null) . '>
                    <span class="c-switch-slider"></span>
                </label>';

            });
            $table->editColumn('product_offers', function ($row) {
                $labels = [];
                foreach ($row->product_offers as $product_offer) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $product_offer->name);
                }

                return implode(' ', $labels);
            });

            $table->editColumn('shipping_method', function ($row) {
                return $row->shipping_method ? Product::SHIPPING_METHOD_SELECT[$row->shipping_method] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'most_recent', 'image', 'product_tags', 'product_category', 'user', 'fav', 'product_offers', 'published']);

            return $table->make(true);
        }

        return view('admin.products.index');
    }

    public function create()
    {
        abort_if(Gate::denies('product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product_tags = Tag::pluck('name', 'id');

        $product_categories = Category::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $product_offers = Offer::pluck('name', 'id');



        return view('admin.products.create', compact('product_categories', 'product_offers', 'product_tags', 'users'));
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->all());
        $product->product_tags()->sync($request->input('product_tags', []));
        $product->product_offers()->sync($request->input('product_offers', []));
        foreach ($request->input('image', []) as $file) {
            $product->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('image');
        }

        if ($request->input('file', false)) {
          
                $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');

            }
       
        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $product->id]);
        }
        alert()->success(trans('flash.store.title'), trans('flash.store.body'));
        return redirect()->route('admin.products.index');
    }

    public function edit(Product $product)
    {
        abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product_tags = Tag::pluck('name', 'id');

        $product_categories = Category::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $product_offers = Offer::pluck('name', 'id');

        $product->load('product_tags', 'product_category', 'user', 'product_offers');

        return view('admin.products.edit', compact('product', 'product_categories', 'product_offers', 'product_tags', 'users'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->all());
        $product->product_tags()->sync($request->input('product_tags', []));
        $product->product_offers()->sync($request->input('product_offers', []));
        if (count($product->image) > 0) {
            foreach ($product->image as $media) {
                if (!in_array($media->file_name, $request->input('image', []))) {
                    $media->delete();
                }
            }
        }
        $media = $product->image->pluck('file_name')->toArray();
        foreach ($request->input('image', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $product->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('image');
            }
        }
        alert()->success(trans('flash.update.title'), trans('flash.update.body'));
        return redirect()->route('admin.products.index');
    }

    public function show(Product $product)
    {
        abort_if(Gate::denies('product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->load('product_tags', 'product_category', 'user', 'product_offers');

        return view('admin.products.show', compact('product'));
    }

    public function destroy(Product $product)
    {
        abort_if(Gate::denies('product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->delete();
        alert()->success(trans('flash.destroy.title'), trans('flash.destroy.body'));
        return back();
    }

    public function massDestroy(MassDestroyProductRequest $request)
    {
        $products = Product::find(request('ids'));

        foreach ($products as $product) {
            $product->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('product_create') && Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new Product();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
