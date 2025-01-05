@if ($flashSale)
    <section id="wsus__flash_sell" class="wsus__flash_sell_2">
        <div class=" container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="offer_time"
                        style="background: url({{ asset('frontend/assets') }}/images/flash_sell_bg.jpg)">
                        <div class="wsus__flash_coundown">
                            <span class=" end_text">{{ $flashSale->name }}</span>
                            <div class="simply-countdown simply-countdown-one"></div>
                            <a class="common_btn" href="#">see more <i class="fas fa-caret-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @if (count($flashSale->items) > 0)
                @foreach ($flashSale->items as $item)
                    <div class="row flash_sell_slider">
                        <div class="col-xl-3 col-sm-6 col-lg-4">
                            <div class="wsus__product_item">
                                <span
                                    class="wsus__new">{{ ($item->product->is_best ? 'Best' : $item->product->is_top) ? 'Top' : 'New' }}</span>
                                <span
                                    class="wsus__minus">-{{ discountPercentage($item->product->price, $item->discounted_price) }}</span>
                                <a class="wsus__pro_link" href="product_details.html">
                                    <img src="{{ asset($item->product->thumb_image) }}" alt="product"
                                        class="img-fluid w-100 img_1" />
                                    @if ($item->product->imageGallery[0])
                                        <img src="{{ asset($item->product->imageGallery[0]->image) }}" alt="product"
                                            class="img-fluid w-100 img_2" />
                                    @endif
                                </a>
                                <ul class="wsus__single_pro_icon">
                                    <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                                class="far fa-eye"></i></a></li>
                                    <li><a href="#"><i class="far fa-heart"></i></a></li>
                                    <li><a href="#"><i class="far fa-random"></i></a>
                                </ul>
                                <div class="wsus__product_details">
                                    <a class="wsus__category" href="#">{{ $item->product->category->name }} </a>
                                    <p class="wsus__pro_rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <span>(133 review)</span>
                                    </p>
                                    <a class="wsus__pro_name" href="#">{{ $item->product->name }}</a>
                                    <p class="wsus__price">${{ $item->product->price - $item->discounted_price }}
                                        <del>${{ $item->product->price }}</del>
                                    </p>
                                    <a class="add_cart" href="#">add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </section>
@endif
