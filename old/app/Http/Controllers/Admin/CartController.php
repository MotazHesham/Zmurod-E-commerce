<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCartRequest;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('cart_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carts = Cart::with(['user', 'products'])->get();

        return view('admin.carts.index', compact('carts'));
    }

    public function create()
    {
        abort_if(Gate::denies('cart_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('name', 'id');

        return view('admin.carts.create', compact('products', 'users'));
    }

    public function store(StoreCartRequest $request)
    {
        $cart = Cart::create($request->all());
        $cart->products()->sync($request->input('products', []));
        alert()->success(trans('flash.store.title'),trans('flash.store.body'));
        return redirect()->route('admin.carts.index');
    }

    public function edit(Cart $cart)
    {
        abort_if(Gate::denies('cart_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('name', 'id');

        $cart->load('user', 'products');

        return view('admin.carts.edit', compact('cart', 'products', 'users'));
    }

    public function update(UpdateCartRequest $request, Cart $cart)
    {
        $cart->update($request->all());
        $cart->products()->sync($request->input('products', []));
        alert()->success(trans('flash.update.title'),trans('flash.update.body'));
        return redirect()->route('admin.carts.index');
    }

    public function show(Cart $cart)
    {
        abort_if(Gate::denies('cart_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cart->load('user', 'products');

        return view('admin.carts.show', compact('cart'));
    }

    public function destroy(Cart $cart)
    {
        abort_if(Gate::denies('cart_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cart->delete();
        alert()->success(trans('flash.destroy.title'),trans('flash.destroy.body'));
        return back();
    }

    public function massDestroy(MassDestroyCartRequest $request)
    {
        $carts = Cart::find(request('ids'));

        foreach ($carts as $cart) {
            $cart->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
