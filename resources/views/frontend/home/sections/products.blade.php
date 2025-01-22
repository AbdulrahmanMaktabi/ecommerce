@if ($products)

    <div class="row flash_sell_slider">
        @foreach ($products as $product)
            <div class="col-xl-3 col-sm-6 col-lg-4">
                <form class="shopping-cart-form" id="shopping-cart-form-{{ $product->id }}"
                    data-product="{{ $product->slug }}">
                    <input type="hidden" name="productID" value="{{ $product->id }}">
                    <input type="hidden" name="qty" value="1">
                    <div class="wsus__product_item">
                        <span
                            class="wsus__new">{{ ($product->is_best ? 'Best' : $product->is_top) ? 'Top' : 'New' }}</span>
                        <span class="wsus__minus">
                            {{ discountPercentage($product->price, $product->discounted_price) }}%
                        </span>
                        <a class="wsus__pro_link"href="{{ route('frontend.product', ['slug' => $product->slug]) }}">
                            <img src="{{ asset($product->thumb_image) }}" alt="product"
                                class="img-fluid w-100 img_1" />
                            <img src="/uploads/product_676c132d7d5c6.png" alt="product"
                                class="img-fluid w-100 img_2" />
                        </a>
                        <ul class="wsus__single_pro_icon">
                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal2"><i
                                        class="far fa-eye"></i></a></li>
                            <li><a href="#"><i class="far fa-heart"></i></a></li>
                            <li><a href="#"><i class="far fa-random"></i></a>
                        </ul>
                        <div class="wsus__product_details">
                            <a class="wsus__category"
                                href="http://127.0.0.1:8000/product/cheeseburger">{{ $product->childCategory->name }}
                            </a>
                            <p class="wsus__pro_rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span>(133 review)</span>
                            </p>
                            <a class="wsus__pro_name" href="#">{{ $product->name }}</a>
                            <p class="wsus__price">{{ $generalSettings->currency_icon }}{{ $product->offer_price }}
                                <del>{{ $generalSettings->currency_icon }}{{ $product->price }}</del>
                            </p>
                            @if (count($product->variants) > 0)
                                <div class="wsus__selectbox">
                                    <div class="row">
                                        @foreach ($product->variants as $variant)
                                            <div class="col-xl-6 col-sm-6">
                                                <h5 class="mb-2">{{ $variant->name }}:</h5>
                                                <select class="select_2" name="variants[]"
                                                    data-variant-price="{{ $variant->price }}"
                                                    data-product-id="{{ $item->id }}">
                                                    {{-- <option disabled>default select</option> --}}
                                                    @foreach ($variant->variantItems as $option)
                                                        <option value="{{ $option->id }}"
                                                            data-price="{{ $option->price }}">
                                                            {{ $option->name }}
                                                            +(${{ $option->price }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <input type="submit" value="ADD TO CART" class="add_cart">
                        </div>
                </form>
            </div>
    </div>
@endforeach

</div>
<section id="wsus__flash_sell" class="wsus__flash_sell_2">
    <div class=" container">
        <div class="row flash_sell_slider slick-initialized slick-slider">
            <div class="slick-list draggable">
                @if (count($products) > 0)
                    @foreach ($products as $item)
                        <div class="slick-slide slick-cloned flash_sell_slider">
                            <div class="col-xl-3 col-sm-6 col-lg-4">
                                <form class="shopping-cart-form" id="shopping-cart-form-{{ $item->id }}"
                                    data-product="{{ $item->slug }}">
                                    <input type="hidden" name="productID" value="{{ $item->id }}">
                                    <input type="hidden" name="qty" value="1">
                                    <div class="wsus__product_item">
                                        <span
                                            class="wsus__new">{{ ($item->is_best ? 'Best' : $item->is_top) ? 'Top' : 'New' }}</span>
                                        <span class="wsus__minus">
                                            {{ discountPercentage($item->price, $item->discounted_price) }}%
                                        </span>
                                        <a class="wsus__pro_link"
                                            href="{{ route('frontend.product', ['slug' => $item->slug]) }}">
                                            <img src="{{ asset($item->thumb_image) }}" alt="product"
                                                class="img-fluid w-100 img_1" />
                                            {{-- @if ($item->imageGallery[0])
                                            <img src="{{ asset($item->imageGallery[0]->image) }}" alt="product"
                                                class="img-fluid w-100 img_2" />
                                        @endif --}}
                                        </a>
                                        <ul class="wsus__single_pro_icon">
                                            <li><a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal-{{ $item->id }}"><i
                                                        class="far fa-eye"></i></a></li>
                                            <li><a href="#"><i class="far fa-heart"></i></a></li>
                                            <li><a href="#"><i class="far fa-random"></i></a>
                                        </ul>
                                        <div class="wsus__product_details">
                                            <a class="wsus__category"
                                                href="{{ route('frontend.product', ['slug' => $item->slug]) }}">{{ $item->category->name }}
                                            </a>
                                            <p class="wsus__pro_rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                                <span>(133 review)</span>
                                            </p>
                                            <a class="wsus__pro_name"
                                                href="{{ route('frontend.product', ['slug' => $item->slug]) }}">{{ $item->name }}</a>
                                            @if (checkDiscount($item))
                                                <p class="wsus__price">
                                                    {{ $generalSettings->currency_icon }}{{ $item->offer_price - $item->discounted_price }}
                                                    <del>${{ $item->price }}</del>
                                                </p>
                                            @else
                                                <p class="wsus__price">
                                                    {{ $generalSettings->currency_icon }}{{ $item->price - $item->discounted_price }}
                                                    <del>${{ $item->price }}</del>
                                                </p>
                                            @endif
                                            @if (count($item->variants) > 0)
                                                <div class="wsus__selectbox">
                                                    <div class="row">
                                                        @foreach ($item->variants as $variant)
                                                            <div class="col-xl-6 col-sm-6">
                                                                <h5 class="mb-2">{{ $variant->name }}:</h5>
                                                                <select class="select_2" name="variants[]"
                                                                    data-variant-price="{{ $variant->price }}"
                                                                    data-product-id="{{ $item->id }}">
                                                                    {{-- <option disabled>default select</option> --}}
                                                                    @foreach ($variant->variantItems as $option)
                                                                        <option value="{{ $option->id }}"
                                                                            data-price="{{ $option->price }}">
                                                                            {{ $option->name }}
                                                                            +(${{ $option->price }})
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                            <input type="submit" value="ADD TO CART" class="add_cart">
                                            {{-- <a class="add_cart" href="#">add to cart</a> --}}
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>

@push('scripts')
    <script>
        // Get the CSRF token value
        let csrfToken = $('meta[name="csrf-token"]').attr('content');
        $('.shopping-cart-form').on('submit', function(e) {
            e.preventDefault();
            let formId = $(this).attr('id');
            let formData = $(this).serialize();
            console.log('formData = ' + formData);
            let productID = $('')
            $.ajax({
                method: 'POST',
                url: "{{ route('frontend.cart.add') }}",
                data: formData + '&_token=' + csrfToken,
                success: function(response) {
                    console.log(`Form ${formId} Response:`, response);
                    alert('Item added to cart successfully!');
                },
                error: function(error) {
                    console.error(`Form ${formId} Error:`, error);
                    alert('An error occurred. Please try again.');
                }
            });
        });
    </script>
    <script>
        // Get the Flash Sale End Time from Blade Variable
        var endTime = new Date('{{ $flashSale->end_time }}');

        // Initialize Countdown
        simplyCountdown('.simply-countdown-one', {
            year: endTime.getFullYear(),
            month: endTime.getMonth() + 1, // Months are zero-indexed
            day: endTime.getDate(),
            hours: endTime.getHours(),
            minutes: endTime.getMinutes(),
            seconds: endTime.getSeconds(),
            enableUtc: true, // Use UTC to ensure consistency
            onEnd: function() {
                // Replace Countdown with "Sale Ended" Message
                document.querySelector('.simply-countdown-one').innerHTML = '<h2>Flash Sale Ended!</h2>';
            }
        });
    </script>
@endpush
@endif
