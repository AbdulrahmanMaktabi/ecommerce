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
                            <a class="common_btn" href="{{ route('frontend.flashSale') }}">see more <i
                                    class="fas fa-caret-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @if (count($flashSale->items) > 0)
                @php
                    $flashSale->items;
                @endphp
                @foreach ($flashSale->items as $item)
                    <div class="row flash_sell_slider">
                        <div class="col-xl-3 col-sm-6 col-lg-4">
                            <form class="shopping-cart-form" id="shopping-cart-form-{{ $item->product->id }}"
                                data-product="{{ $item->product->slug }}">
                                <input type="hidden" name="productID" value="{{ $item->product->id }}">
                                <input type="hidden" name="qty" value="1">
                                <div class="wsus__product_item">
                                    <span
                                        class="wsus__new">{{ ($item->product->is_best ? 'Best' : $item->product->is_top) ? 'Top' : 'New' }}</span>
                                    <span class="wsus__minus">
                                        {{ discountPercentage($item->product->price, $item->discounted_price) }}%
                                    </span>
                                    <a class="wsus__pro_link"
                                        href="{{ route('frontend.product', ['slug' => $item->product->slug]) }}">
                                        <img src="{{ asset($item->product->thumb_image) }}" alt="product"
                                            class="img-fluid w-100 img_1" />
                                        @if ($item->product->imageGallery[0])
                                            <img src="{{ asset($item->product->imageGallery[0]->image) }}"
                                                alt="product" class="img-fluid w-100 img_2" />
                                        @endif
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
                                            href="{{ route('frontend.product', ['slug' => $item->product->slug]) }}">{{ $item->product->category->name }}
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
                                            href="{{ route('frontend.product', ['slug' => $item->product->slug]) }}">{{ $item->product->name }}</a>
                                        @if (checkDiscount($item?->product))
                                            <p class="wsus__price">
                                                {{ $generalSettings->currency_icon }}{{ $item->product->offer_price - $item->discounted_price }}
                                                <del>{{ $generalSettings->currency_icon . $item->product->price }}</del>
                                            </p>
                                        @else
                                            <p class="wsus__price">
                                                {{ $generalSettings->currency_icon }}{{ $item->product->price - $item->discounted_price }}
                                                <del>{{ $generalSettings->currency_icon . $item->product->price }}</del>
                                            </p>
                                        @endif
                                        @if (count($item->product->variants) > 0)
                                            <div class="wsus__selectbox">
                                                <div class="row">
                                                    @foreach ($item->product->variants as $variant)
                                                        <div class="col-xl-6 col-sm-6">
                                                            <h5 class="mb-2">{{ $variant->name }}:</h5>
                                                            <select class="select_2" name="variants[]"
                                                                data-variant-price="{{ $variant->price }}"
                                                                data-product-id="{{ $item->product->id }}">
                                                                {{-- <option disabled>default select</option> --}}
                                                                @foreach ($variant->variantItems as $option)
                                                                    <option value="{{ $option->id }}"
                                                                        data-price="{{ $option->price }}">
                                                                        {{ $option->name }} +(${{ $option->price }})
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
                let cartBagIcon = $('#cart-icon');
                $.ajax({
                    method: 'POST',
                    url: "{{ route('frontend.cart.add') }}",
                    data: formData + '&_token=' + csrfToken,
                    success: function(response) {
                        console.log(`Form ${formId} Response:`, response);
                        alert('Item added to cart successfully!');
                        //to do refresh the count of cart realtime
                        // console.log(cartBagIcon);
                        // cartBagIcon.innerText = {{ Cart::count() }};

                    },
                    error: function(error) {
                        console.error(`Form ${formId} Error:`, error);
                        alert('An error occurred. Please try again.');
                    }
                });
            });
        </script>
        @if (isset($flashSale))
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
        @endif
    @endpush
@endif
