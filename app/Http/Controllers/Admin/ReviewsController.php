<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyReviewRequest;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ReviewsController extends Controller
{
    function update_statuses(Request $request)
    {
        $column_name = $request->column_name;
        $banner = Review::find($request->id);
        $banner->$column_name = $request->published;
        $banner->save();
        return 1;
    }

    public function index(Request $request)
    {
        abort_if(Gate::denies('review_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Review::with(['user_review', 'product_review'])->select(sprintf('%s.*', (new Review)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'review_show';
                $editGate      = 'review_edit';
                $deleteGate    = 'review_delete';
                $crudRoutePart = 'reviews';

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
            $table->editColumn('rating', function ($row) {
                return $row->rating ? $row->rating : '';
            });
            $table->editColumn('comment', function ($row) {
                return $row->comment ? $row->comment : '';
            });
            $table->editColumn('published', function ($row) {
                return  ' <label class="c-switch c-switch-pill c-switch-success">
                        <input onchange="update_statuses(this,\'published\')" value="' . $row->id . '" 
                            type="checkbox" class="c-switch-input" ' . ($row->published ? "checked" : null) . '>
                        <span class="c-switch-slider"></span>
                    </label>';
            });
            $table->addColumn('user_review_name', function ($row) {
                return $row->user_review ? $row->user_review->name : '';
            });

            $table->addColumn('product_review_name', function ($row) {
                return $row->product_review ? $row->product_review->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'published', 'user_review', 'product_review']);

            return $table->make(true);
        }

        return view('admin.reviews.index');
    }

    public function edit(Review $review)
    {
        abort_if(Gate::denies('review_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_reviews = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $product_reviews = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $review->load('user_review', 'product_review');

        return view('admin.reviews.edit', compact('product_reviews', 'review', 'user_reviews'));
    }

    public function update(UpdateReviewRequest $request, Review $review)
    {
        $review->update($request->all());
        alert()->success(trans('flash.update.title'), trans('flash.update.body'));
        return redirect()->route('admin.reviews.index');
    }

    public function show(Review $review)
    {
        abort_if(Gate::denies('review_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $review->load('user_review', 'product_review');

        return view('admin.reviews.show', compact('review'));
    }

    public function destroy(Review $review)
    {
        abort_if(Gate::denies('review_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $review->delete();
        alert()->success(trans('flash.destroy.title'), trans('flash.destroy.body'));
        return back();
    }

    public function massDestroy(MassDestroyReviewRequest $request)
    {
        $reviews = Review::find(request('ids'));

        foreach ($reviews as $review) {
            $review->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
