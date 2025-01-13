@extends('frontend.layouts.master')

@section('content')
    @foreach ($flashSale->items as $item)
        <!--==========================
                                                                                                                                                                                                                                                                                                                         PRODUCT MODAL VIEW START
                                                                                                                                                                                                                                                                                                                        ===========================-->
        <section class="product_popup_modal">
            <div class="modal fade" id="exampleModal-{{ $item->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                    class="far fa-times"></i></button>
                            <div class="row">
                                <div class="col-xl-6 col-12 col-sm-10 col-md-8 col-lg-6 m-auto display">
                                    <div class="wsus__quick_view_img">
                                        <a class="venobox wsus__pro_det_video" data-autoplay="true" data-vbtype="video"
                                            href="{{ $item->product->video_link }}">
                                            <i class="fas fa-play"></i>
                                        </a>
                                        @if (count($item->product->imageGallery) > 0)
                                            <div class="row modal_slider">
                                                @foreach ($item->product->imageGallery as $item)
                                                    <div class="col-xl-12">
                                                        <div class="modal_slider_img">
                                                            <img src="{{ asset($item->image) }}" alt="product"
                                                                class="img-fluid w-100">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-xl-6 col-12 col-sm-12 col-md-12 col-lg-6">
                                    <div class="wsus__pro_details_text">
                                        <a class="title" href="#">{{ $item->product->name }}</a>
                                        <p class="wsus__stock_area"><span class="in_stock">in stock</span>
                                            (167 item)
                                        </p>
                                        @if (checkDiscount($item->product))
                                            <h4>${{ $item->product->offer_price }} <del>${{ $item->product->price }}</del>
                                            </h4>
                                        @else
                                            <h4>${{ $item->product->price }}</h4>
                                        @endif
                                        <p class="review">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                            <span>20 review</span>
                                        </p>
                                        <p class="description">{{ $item->product->short_description }}</p>
                                        <form class="shopping-cart-form" data-product="{{ $item->product->slug }}">
                                            <div class="wsus__quentity">
                                                <h5>quentity :</h5>
                                                <div class="select_number">
                                                    <input class="number_area" type="text" min="1" max="100"
                                                        value="1" />
                                                </div>

                                                @if (checkDiscount($item->product))
                                                    <h4>${{ $item->product->offer_price }}
                                                        <del>${{ $item->product->price }}</del>
                                                    </h4>
                                                @else
                                                    <h4>${{ $item->product->price }}</h4>
                                                @endif
                                            </div>

                                            @if (count($item->product->variants) > 0)
                                                <div class="wsus__selectbox">
                                                    <div class="row">
                                                        @foreach ($item->product->variants as $variant)
                                                            <div class="col-xl-6 col-sm-6">
                                                                <h5 class="mb-2">{{ $variant->name }}:</h5>
                                                                <select class="select_2" name="{{ $variant->name }}">
                                                                    <option disabled>default select</option>
                                                                    @foreach ($variant->variantItems as $option)
                                                                        <option value="{{ $option->id }}">
                                                                            {{ $option->name }} +(${{ $option->price }})
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif

                                            <ul class="wsus__button_area">
                                                <li><a class="add_cart" href="#">add to cart</a></li>
                                                <li><a class="buy_now" href="#">buy now</a></li>
                                                <li><a href="#"><i class="fal fa-heart"></i></a></li>
                                                <li><a href="#"><i class="far fa-random"></i></a></li>
                                            </ul>
                                        </form>
                                        <p class="brand_model"><span>brand :</span> {{ $item->product->brand->name }}</p>
                                        <p class="brand_model"><span>sku :</span> {{ $item->product->sku }}</p>
                                        <div class="wsus__pro_det_share">
                                            <h5>share :</h5>
                                            <ul class="d-flex">
                                                <li><a class="facebook" href="#"><i class="fab fa-facebook-f"></i></a>
                                                </li>
                                                <li><a class="twitter" href="#"><i class="fab fa-twitter"></i></a>
                                                </li>
                                                <li><a class="whatsapp" href="#"><i class="fab fa-whatsapp"></i></a>
                                                </li>
                                                <li><a class="instagram" href="#"><i class="fab fa-instagram"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--==========================
                                                                                                                                                                                                                                                                                                            PRODUCT MODAL VIEW END
                                                                                                                                                                                                                                                                                                            ===========================-->
    @endforeach
    <!--============================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            BANNER PART 2 START
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ==============================-->
    {{-- @include('frontend.home.sections.slider') --}}
    <section id="wsus__banner">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__banner_content">
                        <div class="row banner_slider">

                            @foreach ($sliders as $slider)
                                <div class="col-xl-12">
                                    <div class="wsus__single_slider"
                                        style="background: url({{ asset($slider->banner) }});">
                                        <div class="wsus__single_slider_text">
                                            <h3>{{ $slider->title }}</h3>
                                            <h1>{{ $slider->type }}</h1>
                                            <h6>start at
                                                {{ $generalSettings->currency_icon }}{{ $slider->starting_price }}
                                            </h6>
                                            <a class="common_btn" href="{{ $slider->btn_url }}">shop now</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--============================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            BANNER PART 2 END
                                                                                                                                                                                                                                                                                                                                                                                                           ==============================-->


    <!--============================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            FLASH SELL START
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ==============================-->
    @include('frontend.home.sections.flashSell')
    <!--============================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            FLASH SELL END
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ==============================-->


    <!--============================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           MONTHLY TOP PRODUCT START
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ==============================-->
    @include('frontend.home.sections.topProducts')
    <!--============================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           MONTHLY TOP PRODUCT END
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ==============================-->


    <!--============================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            BRAND SLIDER START
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ==============================-->
    @include('frontend.home.sections.brandSlider')
    <!--============================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            BRAND SLIDER END
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ==============================-->

    <!--============================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            SINGLE BANNER START
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ==============================-->
    @include('frontend.home.sections.singleBanner')
    <!--============================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            SINGLE BANNER END
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ==============================-->


    <!--============================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            HOT DEALS START
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ==============================-->
    @include('frontend.home.sections.hotDeals')

    <!--============================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            HOT DEALS END
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ==============================-->


    <!--============================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            ELECTRONIC PART START
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ==============================-->
    @include('frontend.home.sections.electronicPart1')

    <!--============================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            ELECTRONIC PART END
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ==============================-->


    <!--============================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            ELECTRONIC PART START
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ==============================-->
    @include('frontend.home.sections.electronicPart2')

    <!--============================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            ELECTRONIC PART END
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ==============================-->


    <!--============================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            LARGE BANNER  START
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ==============================-->
    @include('frontend.home.sections.largeBanner')
    <!--============================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            LARGE BANNER  END
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ==============================-->


    <!--============================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            WEEKLY BEST ITEM START
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ==============================-->
    @include('frontend.home.sections.weeklyBestItem')
    <!--============================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            WEEKLY BEST ITEM END
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ==============================-->


    <!--============================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          HOME SERVICES START
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ==============================-->
    @include('frontend.home.sections.services')
    <!--============================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            HOME SERVICES END
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ==============================-->


    <!--============================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            HOME BLOGS START
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ==============================-->
    @include('frontend.home.sections.blog')
    <!--============================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            HOME BLOGS END
                                                                                           
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {

            $('.shopping-cart-form').on('submit', function(e) {
                e.preventDefault(); // Prevent the form from submitting

                // Get the CSRF token value
                let csrfToken = $('meta[name="csrf-token"]').attr('content');
                let productID = "{{ isset($product) ? $product->id : '' }}";


                let formData = $(this).serialize(); // Serialize the form data
                console.log(formData); // Log the serialized data to the console

                // Send AJAX reuest
                $.ajax({
                    method: 'POST',
                    url: "{{ route('frontend.addToCart') }}", // Use Blade to generate the URL
                    // data: formData + '&_token=' + csrfToken + "&userID=" + authUser +
                    //     "&productID=" + productID,
                    data: formData + '&_token=' + csrfToken + "&productID=" + productID,
                    success: function(response) {
                        console.log('Server Response:', response);
                        // Handle success (e.g., show a success message)
                        alert('Item added to cart successfully!');
                    },
                    error: function(error) {
                        console.error('Error:', error);
                        // Handle error (e.g., show an error message)
                        alert('An error occurred. Please try again.');
                    }
                });
            });
        });
    </script>
@endpush
