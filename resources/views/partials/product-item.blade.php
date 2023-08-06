@php
    if (isset($product->image)) {
        $image_first = isset($product->image[0]) ? $product->image[0]->getUrl('preview2') : asset('assets/images/blank.jpg');
        $image_second = isset($product->image[1]) ? $product->image[1]->getUrl('preview2') : $image_first;
    } else {
        $image_first = asset('assets/images/blank.jpg');
        $image_second = asset('assets/images/blank.jpg');
    }
@endphp

<div class="product">
    <div class="thumb">
        <a href="{{ route('frontend.product', $product->id) }}" class="image">
            <img src="{{ $image_first }}" alt="Product" width="300px" height="300px"/>
            <img class="hover-image" src="{{ $image_second }}" alt="Product" />
        </a>
        <span class="badges">
            @foreach ($product->product_offers as $offer )
                <span class="new"> {{$offer->name}}</span>
            @endforeach
        </span>
        {{-- popup and whitelist  --}}
        <div class="actions">
            <a href="#" class="action wishlist"
                title="Wishlist"
                onclick="add_to_whitelist('{{$product->id}}')"><i class="pe-7s-like"></i>
            </a>
            <a href="#" class="action quickview" 
                title="Quick view"
                onclick="quickView('{{$product->id}}')"
                >
                <i class="pe-7s-look"></i>
            </a>
        </div>
    </div>
    <div class="content">
        <span class="ratings">
            <span class="rating-wrap">
                <span class="star" style="width: 100%"></span>
            </span>
            <span class="rating-num">( 5 Review )</span>
        </span>
        <h5 class="title"><a href="{{ route('frontend.product', $product->id) }}">{{
                $product->name }}
            </a>
        </h5>
        <span class="price">
            @if($product->discount > 0)
                <span class="new">{{ $product->calc_product_price() }}</span>
                <span class="old">{{ $product->price }}</span>
            @else 
                <span class="new">{{ $product->price }}</span>
            @endif
        </span>
    </div>  
    <button  title="أضف الى السلة" class=" add-to-cart"
        onclick="add_to_cart('{{$product->id}}')">أضف الى السلة
    </button> 
    
</div>


