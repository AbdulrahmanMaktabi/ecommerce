@extends('frontend.layouts.master')
@section('content')
    <!--==========================
                                   PRODUCT MODAL VIEW START
                                   ===========================-->
    <section class="product_popup_modal">
        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                class="far fa-times"></i></button>
                        <div class="row">
                            <div class="col-xl-6 col-12 col-sm-10 col-md-8 col-lg-6 m-auto display">
                                <div class="wsus__quick_view_img">
                                    <a class="venobox wsus__pro_det_video" data-autoplay="true" data-vbtype="video"
                                        href="https://youtu.be/7m16dFI1AF8">
                                        <i class="fas fa-play"></i>
                                    </a>
                                    <div class="row modal_slider">
                                        <div class="col-xl-12">
                                            <div class="modal_slider_img">
                                                <img src="images/zoom1.jpg" alt="product" class="img-fluid w-100">
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="modal_slider_img">
                                                <img src="images/zoom2.jpg" alt="product" class="img-fluid w-100">
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="modal_slider_img">
                                                <img src="images/zoom3.jpg" alt="product" class="img-fluid w-100">
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="modal_slider_img">
                                                <img src="images/zoom4.jpg" alt="product" class="img-fluid w-100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-12 col-sm-12 col-md-12 col-lg-6">
                                <div class="wsus__pro_details_text">
                                    <a class="title" href="#">Electronics Black Wrist Watch</a>
                                    <p class="wsus__stock_area"><span class="in_stock">in stock</span> (167 item)</p>
                                    <h4>$50.00 <del>$60.00</del></h4>
                                    <p class="review">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <span>20 review</span>
                                    </p>
                                    <p class="description">{{ $product->short_description }}</p>
                                    <div class="wsus_pro_det_color">
                                        <h5>color :</h5>
                                        <ul>
                                            <li><a class="blue" href="#"><i class="far fa-check"></i></a></li>
                                            <li><a class="orange" href="#"><i class="far fa-check"></i></a></li>
                                            <li><a class="yellow" href="#"><i class="far fa-check"></i></a></li>
                                            <li><a class="black" href="#"><i class="far fa-check"></i></a></li>
                                            <li><a class="red" href="#"><i class="far fa-check"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="wsus_pro__det_size">
                                        <h5>size :</h5>
                                        <ul>
                                            <li><a href="#">S</a></li>
                                            <li><a href="#">M</a></li>
                                            <li><a href="#">L</a></li>
                                            <li><a href="#">XL</a></li>
                                        </ul>
                                    </div>
                                    <div class="wsus__quentity">
                                        <h5>quentity :</h5>
                                        <form class="select_number">
                                            <input class="number_area" type="text" min="1" max="100"
                                                value="1" />
                                        </form>
                                        {{-- 
                           <div class="product-price"> --}}
                                        {{-- <span id="productPrice"></span> --}}
                                        {{-- <span id="productPrice">${{ $product->price }}</span> --}}
                                        {{-- 
                           </div>
                           --}}
                                    </div>
                                    <ul class="wsus__button_area">
                                        <li><a class="add_cart" href="#">add to cart</a></li>
                                        <li><a class="buy_now" href="#">buy now</a></li>
                                        <li><a href="#"><i class="fal fa-heart"></i></a></li>
                                        <li><a href="#"><i class="far fa-random"></i></a></li>
                                    </ul>
                                    <p class="brand_model"><span>model :</span> 12345670</p>
                                    <p class="brand_model"><span>brand :</span> The Northland</p>
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
    <!--============================
                                   BREADCRUMB START
                                   ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>{{ $product->name }}</h4>
                        <ul>
                            <li><a href="{{ route('frontend.home') }}">home</a></li>
                            <li><a href="{{ route('frontend.product', ['slug' => $product->slug]) }}">peoduct</a></li>
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
                                   PRODUCT DETAILS START
                                   ==============================-->
    <section id="wsus__product_details">
        <div class="container">
            <div class="wsus__details_bg">
                <div class="row">
                    <div class="col-xl-4 col-md-5 col-lg-5">
                        <div id="sticky_pro_zoom">
                            <div class="exzoom hidden" id="exzoom">
                                <div class="exzoom_img_box">
                                    @if ($product->video_link)
                                        <a class="venobox wsus__pro_det_video" data-autoplay="true" data-vbtype="video"
                                            href="{{ $product->video_link }}">
                                            <i class="fas fa-play"></i>
                                        </a>
                                    @endif
                                    <ul class='exzoom_img_ul'>
                                        <li><img class="zoom ing-fluid w-100" src="{{ $product->thumb_image }}"
                                                alt="product"></li>
                                        @foreach ($product->imageGallery as $image)
                                            <li><img class="zoom ing-fluid w-100" src="{{ $image->image }}"
                                                    alt="product"></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="exzoom_nav"></div>
                                <p class="exzoom_btn">
                                    <a href="javascript:void(0);" class="exzoom_prev_btn"> <i
                                            class="far fa-chevron-left"></i> </a>
                                    <a href="javascript:void(0);" class="exzoom_next_btn"> <i
                                            class="far fa-chevron-right"></i> </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-md-7 col-lg-7">
                        <div class="wsus__pro_details_text">
                            <a class="title" href="#">{{ $product->name }}</a>
                            @if ($product->qty > 0)
                                <p class="wsus__stock_area"><span class="in_stock">in stock</span> ({{ $product->qty }}
                                    item)</p>
                            @else
                                <p class="wsus__stock_area"><span class="in_stock">out stock</span></p>
                            @endif
                            @if (checkIfPriceNotSameToOfferPrice($product->price, $product->offer_price))
                                <h4>${{ $product->offer_price }} <del>${{ $product->price }}</del></h4>
                            @else
                                <h4>${{ $product->price }} </h4>
                            @endif
                            <p class="review">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span>20 review</span>
                            </p>
                            <p class="description">{{ $product->short_description }}</p>
                            <form class="shopping-cart-form">
                                @if (count($product->variants) > 0)
                                    <div class="wsus__selectbox">
                                        <div class="row">
                                            @foreach ($product->variants as $variant)
                                                <div class="col-xl-6 col-sm-6">
                                                    <h5 class="mb-2">{{ $variant->name }}:</h5>
                                                    <select class="select_2" name="variants[]"
                                                        data-variant-price="{{ $variant->price }}"
                                                        data-product-id="{{ $product->id }}">
                                                        {{-- 
                                 <option value="">Choose One</option>
                                 --}}
                                                        @foreach ($variant->variantItems as $item)
                                                            <option value="{{ $item->id }}"
                                                                data-price="{{ $item->price }}">
                                                                {{ $item->name }} (+${{ $item->price }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div class="wsus__quentity">
                                    <h5>quentity :</h5>
                                    <div class="select_number">
                                        <input class="number_area" type="text" min="1" max="100"
                                            value="1" name="qty" />
                                    </div>
                                </div>
                                <ul class="wsus__button_area">
                                    <li><input class="add_cart" type="submit" value="add to cart"> </li>
                                    <li><a class="buy_now" href="#">buy now</a></li>
                                    <li><a href="#"><i class="fal fa-heart"></i></a></li>
                                    <li><a href="#"><i class="far fa-random"></i></a></li>
                                </ul>
                            </form>
                            <p class="brand_model"><span>sku :</span> {{ $product->sku }}</p>
                            <p class="brand_model"><span>brand :</span> {{ $product->brand->name }}</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-12 mt-md-5 mt-lg-0">
                        <div class="wsus_pro_det_sidebar" id="sticky_sidebar">
                            <ul>
                                <li>
                                    <span><i class="fal fa-truck"></i></span>
                                    <div class="text">
                                        <h4>Return Available</h4>
                                        <!-- <p>Lorem Ipsum is simply dummy text of the printing</p> -->
                                    </div>
                                </li>
                                <li>
                                    <span><i class="far fa-shield-check"></i></span>
                                    <div class="text">
                                        <h4>Secure Payment</h4>
                                        <!-- <p>Lorem Ipsum is simply dummy text of the printing</p> -->
                                    </div>
                                </li>
                                <li>
                                    <span><i class="fal fa-envelope-open-dollar"></i></span>
                                    <div class="text">
                                        <h4>Warranty Available</h4>
                                        <!-- <p>Lorem Ipsum is simply dummy text of the printing</p> -->
                                    </div>
                                </li>
                            </ul>
                            <div class="wsus__det_sidebar_banner">
                                <img src="images/blog_1.jpg" alt="banner" class="img-fluid w-100">
                                <div class="wsus__det_sidebar_banner_text_overlay">
                                    <div class="wsus__det_sidebar_banner_text">
                                        <p>Black Friday Sale</p>
                                        <h4>Up To 70% Off</h4>
                                        <a href="#" class="common_btn">shope now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__pro_det_description">
                        <div class="wsus__details_bg">
                            <ul class="nav nav-pills mb-3" id="pills-tab3" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-home-tab7" data-bs-toggle="pill"
                                        data-bs-target="#pills-home22" type="button" role="tab"
                                        aria-controls="pills-home" aria-selected="true">Description</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-contact" type="button" role="tab"
                                        aria-controls="pills-contact" aria-selected="false">Vendor Info</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab2" data-bs-toggle="pill"
                                        data-bs-target="#pills-contact2" type="button" role="tab"
                                        aria-controls="pills-contact2" aria-selected="false">Reviews</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab23" data-bs-toggle="pill"
                                        data-bs-target="#pills-contact23" type="button" role="tab"
                                        aria-controls="pills-contact23" aria-selected="false">comment</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent4">
                                <div class="tab-pane fade  show active " id="pills-home22" role="tabpanel"
                                    aria-labelledby="pills-home-tab7">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="wsus__description_area">
                                                {{ $product->long_description }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                    aria-labelledby="pills-contact-tab">
                                    <div class="wsus__pro_det_vendor">
                                        <div class="row">
                                            <div class="col-xl-6 col-xxl-5 col-md-6">
                                                <div class="wsus__vebdor_img">
                                                    <img src="{{ $product->vendor->banner }}" alt="vensor"
                                                        class="img-fluid w-100">
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-xxl-7 col-md-6 mt-4 mt-md-0">
                                                <div class="wsus__pro_det_vendor_text">
                                                    <h4>{{ $product->vendor->user->name }}</h4>
                                                    <p class="rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <span>(41 review)</span>
                                                    </p>
                                                    <p><span>Store Name:</span>{{ $product->vendor->store_name }}</p>
                                                    <p><span>Phone:</span> {{ $product->vendor->phone }}</p>
                                                    <p><span>mail:</span> {{ $product->vendor->email }}</p>
                                                    <a href="vendor_details.html" class="see_btn">visit store</a>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="wsus__vendor_details">
                                                    {{ $product->vendor->description }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-contact2" role="tabpanel"
                                    aria-labelledby="pills-contact-tab2">
                                    <div class="wsus__pro_det_review">
                                        <div class="wsus__pro_det_review_single">
                                            <div class="row">
                                                {{-- 
                                 <div class="col-xl-8 col-lg-7">
                                    <div class="wsus__comment_area">
                                       <h4>Reviews <span>02</span></h4>
                                       <div class="wsus__main_comment">
                                          <div class="wsus__comment_img">
                                             <img src="images/client_img_3.jpg" alt="user"
                                                class="img-fluid w-100">
                                          </div>
                                          <div class="wsus__comment_text reply">
                                             <h6>Shopnil mahadi <span>4 <i
                                                class="fas fa-star"></i></span></h6>
                                             <span>09 Jul 2021</span>
                                             <p>Lorem ipsum dolor sit amet, consectetur adipisicing
                                                elit.
                                                Cupiditate sint molestiae eos? Officia, fuga eaque.
                                             </p>
                                             <ul class="">
                                                <li><img src="images/headphone_1.jpg" alt="product"
                                                   class="img-fluid w-100"></li>
                                                <li><img src="images/headphone_2.jpg" alt="product"
                                                   class="img-fluid w-100"></li>
                                                <li><img src="images/kids_1.jpg" alt="product"
                                                   class="img-fluid w-100"></li>
                                             </ul>
                                             <a href="#" data-bs-toggle="collapse"
                                                data-bs-target="#flush-collapsetwo">reply</a>
                                             <div class="accordion accordion-flush"
                                                id="accordionFlushExample2">
                                                <div class="accordion-item">
                                                   <div id="flush-collapsetwo"
                                                      class="accordion-collapse collapse"
                                                      aria-labelledby="flush-collapsetwo"
                                                      data-bs-parent="#accordionFlushExample">
                                                      <div class="accordion-body">
                                                         <form>
                                                            <div
                                                               class="wsus__riv_edit_single text_area">
                                                               <i class="far fa-edit"></i>
                                                               <textarea cols="3" rows="1" placeholder="Your Text"></textarea>
                                                            </div>
                                                            <button type="submit"
                                                               class="common_btn">submit</button>
                                                         </form>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="wsus__main_comment">
                                          <div class="wsus__comment_img">
                                             <img src="images/client_img_1.jpg" alt="user"
                                                class="img-fluid w-100">
                                          </div>
                                          <div class="wsus__comment_text reply">
                                             <h6>Smith jhon <span>5 <i class="fas fa-star"></i></span>
                                             </h6>
                                             <span>09 Jul 2021</span>
                                             <p>Lorem ipsum dolor sit amet, consectetur adipisicing
                                                elit.
                                                Cupiditate sint molestiae eos? Officia, fuga eaque.
                                             </p>
                                             <a href="#" data-bs-toggle="collapse"
                                                data-bs-target="#flush-collapsetwo2">reply</a>
                                             <div class="accordion accordion-flush"
                                                id="accordionFlushExample2">
                                                <div class="accordion-item">
                                                   <div id="flush-collapsetwo2"
                                                      class="accordion-collapse collapse"
                                                      aria-labelledby="flush-collapsetwo"
                                                      data-bs-parent="#accordionFlushExample">
                                                      <div class="accordion-body">
                                                         <form>
                                                            <div
                                                               class="wsus__riv_edit_single text_area">
                                                               <i class="far fa-edit"></i>
                                                               <textarea cols="3" rows="1" placeholder="Your Text"></textarea>
                                                            </div>
                                                            <button type="submit"
                                                               class="common_btn">submit</button>
                                                         </form>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div id="pagination">
                                          <nav aria-label="Page navigation example">
                                             <ul class="pagination">
                                                <li class="page-item">
                                                   <a class="page-link" href="#"
                                                      aria-label="Previous">
                                                   <i class="fas fa-chevron-left"></i>
                                                   </a>
                                                </li>
                                                <li class="page-item"><a class="page-link page_active"
                                                   href="#">1</a>
                                                </li>
                                                <li class="page-item"><a class="page-link"
                                                   href="#">2</a></li>
                                                <li class="page-item"><a class="page-link"
                                                   href="#">3</a></li>
                                                <li class="page-item"><a class="page-link"
                                                   href="#">4</a></li>
                                                <li class="page-item">
                                                   <a class="page-link" href="#"
                                                      aria-label="Next">
                                                   <i class="fas fa-chevron-right"></i>
                                                   </a>
                                                </li>
                                             </ul>
                                          </nav>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-xl-4 col-lg-5 mt-4 mt-lg-0">
                                    <div class="wsus__post_comment rev_mar" id="sticky_sidebar3">
                                       <h4>write a Review</h4>
                                       <form action="#">
                                          <p class="rating">
                                             <span>select your rating : </span>
                                             <i class="fas fa-star"></i>
                                             <i class="fas fa-star"></i>
                                             <i class="fas fa-star"></i>
                                             <i class="fas fa-star"></i>
                                             <i class="fas fa-star"></i>
                                          </p>
                                          <div class="row">
                                             <div class="col-xl-12">
                                                <div class="wsus__single_com">
                                                   <input type="text" placeholder="Name">
                                                </div>
                                             </div>
                                             <div class="col-xl-12">
                                                <div class="wsus__single_com">
                                                   <input type="email" placeholder="Email">
                                                </div>
                                             </div>
                                             <div class="col-xl-12">
                                                <div class="col-xl-12">
                                                   <div class="wsus__single_com">
                                                      <textarea cols="3" rows="3" placeholder="Write your review"></textarea>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="img_upload">
                                             <div class="gallery">
                                                <a class="cam" href="javascript:void(0)"><span><i
                                                   class="fas fa-image"></i></span>
                                                </a>
                                             </div>
                                          </div>
                                          <button class="common_btn" type="submit">submit
                                          review</button>
                                       </form>
                                    </div>
                                 </div>
                                 --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-contact23" role="tabpanel"
                                    aria-labelledby="pills-contact-tab23">
                                    <div class="wsus__pro_det_comment">
                                        <div class="row">
                                            {{-- 
                              <div class="col-xl-7 col-lg-6">
                                 <div class="wsus__comment_area">
                                    <h4>comment <span>03</span></h4>
                                    <div class="wsus__main_comment">
                                       <div class="wsus__comment_img">
                                          <img src="images/dashboard_user.jpg" alt="user"
                                             class="img-fluid w-100">
                                       </div>
                                       <div class="wsus__comment_text reply">
                                          <h6>Shopnil mahadi <span>09 Jul 2021</span></h6>
                                          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                             Cupiditate sint molestiae eos? Officia, fuga eaque.
                                          </p>
                                          <a href="#" data-bs-toggle="collapse"
                                             data-bs-target="#flush-collapsetwo2">reply</a>
                                          <div class="accordion accordion-flush"
                                             id="accordionFlushExample2">
                                             <div class="accordion-item">
                                                <div id="flush-collapsetwo2"
                                                   class="accordion-collapse collapse"
                                                   aria-labelledby="flush-collapsetwo"
                                                   data-bs-parent="#accordionFlushExample">
                                                   <div class="accordion-body">
                                                      <form>
                                                         <div
                                                            class="wsus__riv_edit_single text_area">
                                                            <i class="far fa-edit"></i>
                                                            <textarea cols="3" rows="1" placeholder="Your Text"></textarea>
                                                         </div>
                                                         <button type="submit"
                                                            class="common_btn">submit</button>
                                                      </form>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="wsus__main_comment wsus__com_reply">
                                       <div class="wsus__comment_img">
                                          <img src="images/ts-3.jpg" alt="user"
                                             class="img-fluid w-100">
                                       </div>
                                       <div class="wsus__comment_text reply">
                                          <h6>Smith jhon <span>09 Jul 2021</span></h6>
                                          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                             Cupiditate sint molestiae eos? Officia, fuga eaque.
                                          </p>
                                          <a href="#" data-bs-toggle="collapse"
                                             data-bs-target="#flush-collapsetwo">reply</a>
                                          <div class="accordion accordion-flush"
                                             id="accordionFlushExample">
                                             <div class="accordion-item">
                                                <div id="flush-collapsetwo"
                                                   class="accordion-collapse collapse"
                                                   aria-labelledby="flush-collapsetwo"
                                                   data-bs-parent="#accordionFlushExample">
                                                   <div class="accordion-body">
                                                      <form>
                                                         <div
                                                            class="wsus__riv_edit_single text_area">
                                                            <i class="far fa-edit"></i>
                                                            <textarea cols="3" rows="1" placeholder="Your Text"></textarea>
                                                         </div>
                                                         <button type="submit"
                                                            class="common_btn">submit</button>
                                                      </form>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="wsus__main_comment">
                                       <div class="wsus__comment_img">
                                          <img src="images/team_1.jpg" alt="user"
                                             class="img-fluid w-100">
                                       </div>
                                       <div class="wsus__comment_text reply">
                                          <h6>Smith jhon <span>09 Jul 2021</span></h6>
                                          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                             Cupiditate sint molestiae eos? Officia, fuga eaque.
                                          </p>
                                          <a href="#" data-bs-toggle="collapse"
                                             data-bs-target="#flush-collapsetwo3">reply</a>
                                          <div class="accordion accordion-flush"
                                             id="accordionFlushExample3">
                                             <div class="accordion-item">
                                                <div id="flush-collapsetwo3"
                                                   class="accordion-collapse collapse"
                                                   aria-labelledby="flush-collapsetwo"
                                                   data-bs-parent="#accordionFlushExample">
                                                   <div class="accordion-body">
                                                      <form>
                                                         <div
                                                            class="wsus__riv_edit_single text_area">
                                                            <i class="far fa-edit"></i>
                                                            <textarea cols="3" rows="1" placeholder="Your Text"></textarea>
                                                         </div>
                                                         <button type="submit"
                                                            class="common_btn">submit</button>
                                                      </form>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div id="pagination">
                                       <nav aria-label="Page navigation example">
                                          <ul class="pagination">
                                             <li class="page-item">
                                                <a class="page-link" href="#"
                                                   aria-label="Previous">
                                                <i class="fas fa-chevron-left"></i>
                                                </a>
                                             </li>
                                             <li class="page-item"><a class="page-link page_active"
                                                href="#">1</a></li>
                                             <li class="page-item"><a class="page-link"
                                                href="#">2</a>
                                             </li>
                                             <li class="page-item"><a class="page-link"
                                                href="#">3</a>
                                             </li>
                                             <li class="page-item"><a class="page-link"
                                                href="#">4</a>
                                             </li>
                                             <li class="page-item">
                                                <a class="page-link" href="#"
                                                   aria-label="Next">
                                                <i class="fas fa-chevron-right"></i>
                                                </a>
                                             </li>
                                          </ul>
                                       </nav>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-xl-5 col-lg-6 mt-4 mt-lg-0">
                                 <div class="wsus__post_comment" id="sticky_sidebar2">
                                    <h4>post a comment</h4>
                                    <form action="#">
                                       <div class="row">
                                          <div class="col-xl-6">
                                             <div class="wsus__single_com">
                                                <input type="text" placeholder="Name">
                                             </div>
                                          </div>
                                          <div class="col-xl-6">
                                             <div class="wsus__single_com">
                                                <input type="email" placeholder="Email">
                                             </div>
                                          </div>
                                          <div class="col-xl-12">
                                             <div class="wsus__single_com">
                                                <textarea cols="3" rows="3" placeholder="Your Comment"></textarea>
                                             </div>
                                          </div>
                                       </div>
                                       <button class="common_btn" type="submit">post comment</button>
                                    </form>
                                 </div>
                              </div>
                              --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
                                   PRODUCT DETAILS END
                                   ==============================-->
    <!--============================
                                   RELATED PRODUCT START
                                   
                                   ==============================-->
    @if (isset($subCategory))
        <section id="wsus__flash_sell">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="wsus__section_header">
                            <h3>Related Products</h3>
                            <a class="see_btn" href="#">see more <i class="fas fa-caret-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row flash_sell_slider">
                    @foreach ($subCategory->products as $product)
                        <div class="col-xl-3 col-sm-6 col-lg-4">
                            <div class="wsus__product_item">
                                <span class="wsus__new">New</span>
                                <span class="wsus__minus">-20%</span>
                                <a class="wsus__pro_link"
                                    href="{{ route('frontend.product', ['slug' => $product->slug]) }}">
                                    <img src="{{ $product->thumb_image }}" alt="product"
                                        class="img-fluid w-100 img_1" />
                                    <img src="{{ $product->imageGallery[0]->image }}" alt="product"
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
                                        href="{{ route('frontend.product', ['slug' => $product->slug]) }}">{{ $product->childCategory->name }}
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
                                    @if (checkIfPriceNotSameToOfferPrice($product->price, $product->offer_price))
                                        <p class="wsus__price">${{ $product->offer_price }}
                                            <del>${{ $product->price }}</del>
                                        </p>
                                    @else
                                        <p class="wsus__price">${{ $product->price }}</p>
                                    @endif
                                    <a class="add_cart" href="#">add to cart</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <!--============================
                                   RELATED PRODUCT END
                                   ==============================-->
    @push('scripts')
        {{-- let authUser = "{{ Auth::user()->id }}"; --}}
        <script>
            $(document).ready(function() {
                // Get the CSRF token value
                let csrfToken = $('meta[name="csrf-token"]').attr('content');
                let productID = "{{ $product->id }}";

                $('.shopping-cart-form').on('submit', function(e) {
                    e.preventDefault(); // Prevent the form from submitting
                    let formData = $(this).serialize(); // Serialize the form data
                    console.log(formData); // Log the serialized data to the console

                    // Send AJAX request
                    $.ajax({
                        method: 'POST',
                        url: "{{ route('frontend.cart.add') }}", // Use Blade to generate the URL                    
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
        {{-- <script>
   document.addEventListener('DOMContentLoaded', function() {
       // Listen for the Select2 change event
       document.querySelectorAll('.select_2').forEach(select => {
           $(select).on('change.select2', function() {
               const productId = this.getAttribute('data-product-id');
               const variantItemId = this.value; // Selected variant item ID
   
               // Make an Ajax request to get the updated price
               fetch('{{ route('frontend.product.getVariantPrice') }}', {
                       method: 'POST',
                       headers: {
                           'Content-Type': 'application/json',
                           'X-CSRF-TOKEN': document.querySelector(
                               'meta[name="csrf-token"]').getAttribute('content')
                       },
                       body: JSON.stringify({
                           product_id: productId,
                           variant_item_id: variantItemId
                       })
                   })
                   .then(response => response.json())
                   .then(data => {
                       if (data.newPrice) {
                           // Update the product price
                           const priceElements = document.getElementsByClassName(
                               'productPrice');
                           if (priceElements.length > 0) {
                               // Assuming you want to update the first element with this class
                               priceElements[0].textContent = '$' + data.newPrice.toFixed(
                                   2);
                           } else {
                               console.error(
                                   'No elements with class "productPrice" found.');
                           }
                       }
                   })
                   .catch(error => {
                       console.error('AJAX Error:', error);
                   });
           });
       });
   });
</script> --}}
    @endpush
@endsection
