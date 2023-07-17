
<div class="modal-body">
    <div class="row">
        <div class="col-lg-6 col-sm-12 col-xs-12 mb-lm-30px mb-md-30px mb-sm-30px">
            <!-- Swiper -->
            <div class="swiper-container gallery-top">
                <div class="swiper-wrapper">
                    
                    @foreach ($product->image as $img )
                    <div class="swiper-slide">
                        <img class="img-responsive m-auto" src="{{$img->getUrl()}}" alt="">
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="swiper-container gallery-thumbs mt-20px">
                <div class="swiper-wrapper">
                    @foreach ($product->image as $img )
                    <div class="swiper-slide">
                        <img class="img-responsive m-auto" src="{{$img->getUrl('thumb')}}" alt="">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="200">
            <div class="product-details-content quickview-content">
                <h2>{{$product->name}}</h2>
                <div class="pricing-meta">
                    <ul class="d-flex">
                        <li class="new-price">رس {{$product->price}}</li>
                        <li class="old-price"><del>رس {{$product->price + ($product->price * 0.15)}}</del>
                        </li>
                    </ul>
                </div>
                <div class="pro-details-rating-wrap">
                    <div class="rating-product">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <span class="read-review"><a class="reviews" href="#">( 2 )</a></span>
                </div>
                <div class="stock mt-30px">
                    <span class="avallabillty">الإتاحة: <span class="in-stock"><i
                                class="fa fa-check"></i>متاح</span></span>
                </div>
                <p class="mt-30px mb-0">
                    <?php echo $product->information ?>
                </p>
                <div class="pro-details-quality">
                    <div class="pro-details-cart">
                        <button class="add-cart" onclick="add_to_cart('{{$product->id}}')"> اضف الى
                            السلة</button>
                    </div>
                    <div class="pro-details-compare-wishlist pro-details-wishlist ">
                        <a href="{{route('customer.whitelist.show')}}"><i class="pe-7s-like"></i></a>
                    </div>
                </div>
                <div class="pro-details-categories-info pro-details-same-style d-flex">
                    <span>الفئات: </span>
                    <ul class="d-flex">
                        <li>
                            <a href="#">مكرمية, </a>
                        </li>
                        <li>
                            <a href="#">هاند ميد, </a>
                        </li>
                        <li>
                            <a href="#">ديكور حائط</a>
                        </li>
                    </ul>
                </div>
                <div class="pro-details-social-info pro-details-same-style d-flex">
                    <span>مشاركة: </span>
                    <ul class="d-flex">
                        <li>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-google"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-youtube"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

