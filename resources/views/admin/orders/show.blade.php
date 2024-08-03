@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.order.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.orders.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <div class="container">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.id') }}
                                </th>
                                <td>
                                    {{ $order->id }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.order_num') }}
                                </th>
                                <td>
                                    {{ $order->order_num }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.client_name') }}
                                </th>
                                <td>
                                    {{ $order->client_name }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.phone_number') }}
                                </th>
                                <td>
                                    {{ $order->phone_number }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.phone_number_2') }}
                                </th>
                                <td>
                                    {{ $order->phone_number_2 }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.shipping_address') }}
                                </th>
                                <td>
                                    {{ $order->shipping_address }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.delivery_status') }}
                                </th>
                                <td>
                                    {{ App\Models\Order::DELIVERY_STATUS_SELECT[$order->delivery_status] ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.total_cost') }}
                                </th>
                                <td>
                                    {{ $order->total_cost }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.discount') }}
                                </th>
                                <td>
                                    {{ $order->discount }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.shipment_type') }}
                                </th>
                                <td>
                                    {{ App\Models\Order::SHIPMENT_TYPE_RADIO[$order->shipment_type] ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.city') }}
                                </th>
                                <td>
                                    {{ $order->city }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.user') }}
                                </th>
                                <td>
                                    {{ $order->user->name ?? '' }}
                                </td>
                            </tr>
                            {{-- here the products of the order --}}
                        </tbody>
                    </table>
                    <br><br>
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>{{ trans('cruds.product.title') }}</th>
                                <th>{{ trans('cruds.seller.title') }}</th>
                                <th>{{ trans('cruds.product.fields.price') }}</th>
                                <th>{{ trans('cruds.orderProduct.fields.quantity') }}</th>
                                <th>{{ trans('cruds.cart.fields.total_cost') }}</th>
                            </tr>
                            @foreach ($order->orderProduct as $orderProduct)
                                <tr>
                                    <td>{{ $orderProduct->product->name ?? '' }}</td>
                                    <td>{{ $orderProduct->product->user->name ?? '' }}</td>
                                    <td>{{ $orderProduct->price }}</td>
                                    <td>{{ $orderProduct->quantity }}</td>
                                    <td>{{ $orderProduct->total_cost }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-8"></div>
                        <div class="alert alert-primary col-4 " role="alert">
                            <ul style="list-style: none; margin-left: 12px; font-size: 20px;">
                                <li>
                                    <div class="d-flex"><i class="mr-4">ProductsCost :</i> + {{ $order->total_cost }}
                                    </div>
                                </li>
                                @php
                                    $shipment = \App\Models\AboutUs::find(1);
                                    $normal = $shipment->normal_shipment_cost;
                                    $fast = $shipment->fast_shipment_cost;
                                @endphp
                                <li>
                                    <div class="d-flex"><i class="mr-4">ShipmentCost :</i> +
                                        {{ $order->shipment_type == 'fast' ? $fast : $normal }}</div>
                                </li>
                                <li>
                                    <div class="d-flex"><i class="mr-4">Total Order : </i> =
                                        {{ $order->shipment_type == 'fast' ? $fast + $order->total_cost : $normal + $order->total_cost }}
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>


                </div>
                
            </div>
        </div>
    </div>
@endsection
