@extends('frontend.layouts.master')
@if (isset($flashSale))
    @section('content')
        <!--============================
                                                                                                                                                                                                                                                                        BREADCRUMB START
                                                                                                                                                                                                                                                                    ==============================-->
        <section id="wsus__breadcrumb">
            <div class="wsus_breadcrumb_overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h4>Flash Sale - {{ $flashSale->name }}</h4>
                            <ul>
                                <li><a href="{{ route('frontend.home') }}">home</a></li>
                                <li><a href="{{ route('frontend.flashSale') }}">flash sale</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--============================
                                                                                                                                                                                                                                                                        BREADCRUMB END
                                                                                                                                                                                                                                                                    ==============================-->
        <!--============================
                                                                                                                                                                                                                                                                    PRODUCT PAGE START
                                                                                                                                                                                                                                                                ==============================-->
        <section id="wsus__product_page">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="wsus__pro_page_bammer">
                            <img src="{{ asset('frontend/assets') }}/images/pro_banner_1.jpg" alt="banner"
                                class="img-fluid w-100">
                            <div class="wsus__pro_page_bammer_text">
                                <div class="wsus__pro_page_bammer_text_center">
                                    <p>up to <span>70% off</span></p>
                                    <h5>wemen's jeans Collection</h5>
                                    <h3>fashion for wemen's</h3>
                                    <a href="#" class="add_cart">Discover Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4">
                        <div class="wsus__sidebar_filter ">
                            <p>filter</p>
                            <span class="wsus__filter_icon">
                                <i class="far fa-minus" id="minus"></i>
                                <i class="far fa-plus" id="plus"></i>
                            </span>
                        </div>
                        <div class="wsus__product_sidebar" id="sticky_sidebar">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            All Categories
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul>
                                                <li><a href="#">Accessories</a></li>
                                                <li><a href="#">Babies</a></li>
                                                <li><a href="#">Babies</a></li>
                                                <li><a href="#">Beauty</a></li>
                                                <li><a href="#">Decoration</a></li>
                                                <li><a href="#">Electronics</a></li>
                                                <li><a href="#">Fashion</a></li>
                                                <li><a href="#">Food</a></li>
                                                <li><a href="#">Furniture</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Price
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse show"
                                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="price_ranger">
                                                <input type="hidden" id="slider_range" class="flat-slider" />
                                                <button type="submit" class="common_btn">filter</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree2">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseThree2" aria-expanded="false"
                                            aria-controls="collapseThree">
                                            size
                                        </button>
                                    </h2>
                                    <div id="collapseThree2" class="accordion-collapse collapse show"
                                        aria-labelledby="headingThree2" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    small
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckChecked">
                                                <label class="form-check-label" for="flexCheckChecked">
                                                    medium
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckChecked2">
                                                <label class="form-check-label" for="flexCheckChecked2">
                                                    large
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree3">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseThree3" aria-expanded="false"
                                            aria-controls="collapseThree">
                                            brand
                                        </button>
                                    </h2>
                                    <div id="collapseThree3" class="accordion-collapse collapse show"
                                        aria-labelledby="headingThree3" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefault11">
                                                <label class="form-check-label" for="flexCheckDefault11">
                                                    gentle park
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckChecked22">
                                                <label class="form-check-label" for="flexCheckChecked22">
                                                    colors
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckChecked222">
                                                <label class="form-check-label" for="flexCheckChecked222">
                                                    yellow
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckChecked33">
                                                <label class="form-check-label" for="flexCheckChecked33">
                                                    enice man
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckChecked333">
                                                <label class="form-check-label" for="flexCheckChecked333">
                                                    plus point
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseThree" aria-expanded="true"
                                            aria-controls="collapseThree">
                                            color
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse show"
                                        aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefaultc1">
                                                <label class="form-check-label" for="flexCheckDefaultc1">
                                                    black
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckCheckedc2">
                                                <label class="form-check-label" for="flexCheckCheckedc2">
                                                    white
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckCheckedc3">
                                                <label class="form-check-label" for="flexCheckCheckedc3">
                                                    green
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckCheckedc4">
                                                <label class="form-check-label" for="flexCheckCheckedc4">
                                                    pink
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckCheckedc5">
                                                <label class="form-check-label" for="flexCheckCheckedc5">
                                                    red
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-8">
                        <div class="row">
                            <div class="col-xl-12 d-none d-md-block mt-md-4 mt-lg-0">
                                <div class="wsus__product_topbar">
                                    <div class="wsus__product_topbar_left">
                                        <div class="nav nav-pills" id="v-pills-tab" role="tablist"
                                            aria-orientation="vertical">


                                        </div>
                                        <div class="wsus__topbar_select">
                                            <select class="select_2" name="state">
                                                <option>default shorting</option>
                                                <option>short by rating</option>
                                                <option>short by latest</option>
                                                <option>low to high </option>
                                                <option>high to low</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="wsus__topbar_select">
                                        <select class="select_2" name="state">
                                            <option>show 12</option>
                                            <option>show 15</option>
                                            <option>show 18</option>
                                            <option>show 21</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                    aria-labelledby="v-pills-home-tab">
                                    <div class="row">
                                        @if (count($flashSale->items) > 0)
                                            @foreach ($flashSale->items as $item)
                                                <div class="col-xl-4  col-sm-6">
                                                    <form class="shopping-cart-form"
                                                        id="shopping-cart-form-{{ $item->product->id }}"
                                                        data-product="{{ $item->product->slug }}">
                                                        <input type="hidden" name="productID"
                                                            value="{{ $item->product->id }}">
                                                        <input type="hidden" name="qty" value="1">
                                                        <div class="wsus__product_item">
                                                            <span
                                                                class="wsus__new">{{ productStatus($item->product) }}</span>
                                                            <span
                                                                class="wsus__minus">-{{ discountPercentage($item->product->price, $item->discounted_price) }}%</span>
                                                            <a class="wsus__pro_link"
                                                                href="{{ route('frontend.product', ['slug' => $item->product->slug]) }}">
                                                                <img src="{{ asset($item->product->thumb_image) }}"
                                                                    alt="product" class="img-fluid w-100 img_1" />
                                                                @if ($item->product->imageGallery[0])
                                                                    <img src="{{ asset($item->product->imageGallery[0]->image) }}"
                                                                        alt="product" class="img-fluid w-100 img_2" />
                                                                @endif
                                                            </a>
                                                            <ul class="wsus__single_pro_icon">
                                                                <li><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#exampleModal"><i
                                                                            class="far fa-eye"></i></a>
                                                                </li>
                                                                <li><a href="#"><i class="far fa-heart"></i></a>
                                                                </li>
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
                                                                    <span>(17 review)</span>
                                                                </p>
                                                                <a class="wsus__pro_name"
                                                                    href="#">{{ $item->product->name }}</a>
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
                                                                                    <h5 class="mb-2">
                                                                                        {{ $variant->name }}:</h5>
                                                                                    <select class="select_2"
                                                                                        name="variants[]"
                                                                                        data-variant-price="{{ $variant->price }}"
                                                                                        data-product-id="{{ $item->product->id }}">
                                                                                        {{-- <option disabled>default select</option> --}}
                                                                                        @foreach ($variant->variantItems as $option)
                                                                                            <option
                                                                                                value="{{ $option->id }}"
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
                                                                <input type="submit" value="ADD TO CART"
                                                                    class="add_cart">
                                                                {{-- <a class="add_cart" href="#">add to cart</a> --}}
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <section id="pagination">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <i class="fas fa-chevron-left"></i>
                                        </a>
                                    </li>
                                    <li class="page-item"><a class="page-link page_active" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </section>
                    </div>
                </div>
            </div>
        </section>
        <!--============================
                                                                                                                                                                                                                                                                    PRODUCT PAGE END
                                                                                                                                                                                                                                                                ==============================-->
    @endsection

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
    @endpush
    {{-- <script>
        let form = $('.shopping-cart-form');
        console.log(from);
    </script> --}}

@endif
