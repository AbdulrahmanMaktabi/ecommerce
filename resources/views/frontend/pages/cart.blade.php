@extends('frontend.layouts.master')

@section('title', 'Cart Pge')

@section('content')
    <!--============================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    CART VIEW PAGE START
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ==============================-->
    <section id="wsus__cart_view">
        <div class="container">
            <div class="row">
                @if (isset($cart) && count($cart) > 0)
                    <div class="col-xl-9">
                        <div class="wsus__cart_list">
                            <div class="table-responsive">
                                <table>
                                    <tbody>
                                        <tr class="d-flex">
                                            <th class="wsus__pro_img">
                                                product item
                                            </th>

                                            <th class="wsus__pro_name">
                                                product details
                                            </th>

                                            <th class="wsus__pro_tk">
                                                price
                                            </th>

                                            <th class="wsus__pro_status">
                                                Total Price
                                            </th>

                                            <th class="wsus__pro_select">
                                                quantity
                                            </th>


                                            <th class="wsus__pro_icon">
                                                <a href="{{ route('frontend.cart.destroy') }}" class="common_btn">clear
                                                    cart</a>
                                            </th>
                                        </tr>
                                        @foreach ($cart as $item)
                                            <tr class="d-flex">
                                                <td class="wsus__pro_img"><img
                                                        src="{{ asset($item->options->thumb_image) }}" alt="product"
                                                        class="img-fluid w-100">
                                                </td>

                                                <td class="wsus__pro_name">
                                                    <p>{{ $item->name }}</p>
                                                    @foreach ($item->options->variants as $key => $variant)
                                                        <span>{{ $key }}: {{ $variant['name'] }}</span>
                                                    @endforeach
                                                </td>

                                                <td class="wsus__pro_tk">
                                                    @php
                                                        // dd($item->id);
                                                    @endphp
                                                    <h6>{{ $generalSettings->currency_icon . getProductPrice($item->rowId) }}
                                                    </h6>
                                                </td>

                                                <td class="wsus__pro_status">
                                                    <h6>
                                                        {{ $generalSettings->currency_icon }}
                                                        <span id="total-{{ $item->rowId }}">
                                                            {{ getProductPriceTotal($item->rowId, $item->qty) }}
                                                        </span>
                                                        {{-- <span
                                                            id="total-{{ $item->rowId }}">{{ ($item->price + $item->options->variantsTotalPrice) * $item->qty }}</span> --}}
                                                    </h6>
                                                </td>

                                                <td class="wsus__pro_select">
                                                    @php
                                                        $rowId = $item->rowId;
                                                    @endphp
                                                    <button type="submit"
                                                        class="btn btn-danger decrement-qty-{{ $rowId }}"
                                                        onclick="updateQtyBasedOnRowId(-1 , '{{ $rowId }}')">-</button>
                                                    <input type="text" name="qty" class="qty-{{ $rowId }}"
                                                        style="height:37px;width:40px;text-align:center;margin: 0 5px"
                                                        value="{{ $item->qty }}">
                                                    <button type="submit"
                                                        class="btn btn-success increment-qty-{{ $rowId }}"
                                                        onclick="updateQtyBasedOnRowId(1 , '{{ $rowId }}')">+</button>
                                                    <input type="hidden" data-rowid="{{ $rowId }}" class="rowId">
                                                </td>

                                                <td class="wsus__pro_icon">
                                                    <a
                                                        href="{{ route('frontend.cart.delete', ['rowId' => $item->rowId]) }}"><i
                                                            class="far fa-times"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- Sidebar --}}
                    <div class="col-xl-3">
                        <div class="wsus__cart_list_footer_button" id="sticky_sidebar">
                            <h6>total cart</h6>
                            <p>subtotal:
                                <span>
                                    {{ $generalSettings->currency_icon }}
                                    <span class="sub-total">{{ getSubTotalCartAmount() }}</span>
                                </span>
                            </p>
                            <p>discount:
                                <span>{{ $generalSettings->currency_icon }}
                                    <span class="cart-discount"></span>
                                </span>
                            </p>
                            <p class="total">
                                <span>total:</span>
                                <span>{{ $generalSettings->currency_icon }} <span class="cart-total"></span></span>
                            </p>

                            <form class="coupon-form">
                                <input type="text" placeholder="Coupon Code" name="coupon" class="coupon">
                                <button type="submit" class="common_btn">apply</button>
                            </form>
                            <a class="common_btn mt-4 w-100 text-center" href="{{ route('checkout.index') }}">checkout</a>
                            <a class="common_btn mt-1 w-100 text-center" href="product_grid_view.html"><i
                                    class="fab fa-shopify"></i> go
                                shop</a>
                        </div>
                    </div>
                @else
                    <h1>There is no thing here !!
                    </h1>
                @endif
            </div>
        </div>
    </section>
    <section id="wsus__single_banner">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content">
                        <div class="wsus__single_banner_img">
                            <img src="{{ asset('frontend/assets') }}/images/single_banner_2.jpg" alt="banner"
                                class="img-fluid w-100">
                        </div>
                        <div class="wsus__single_banner_text">
                            <h6>sell on <span>35% off</span></h6>
                            <h3>smart watch</h3>
                            <a class="shop_btn" href="#">shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content single_banner_2">
                        <div class="wsus__single_banner_img">
                            <img src="{{ asset('frontend/assets') }}/images/single_banner_3.jpg" alt="banner"
                                class="img-fluid w-100">
                        </div>
                        <div class="wsus__single_banner_text">
                            <h6>New Collection</h6>
                            <h3>Cosmetics</h3>
                            <a class="shop_btn" href="#">shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      CART VIEW PAGE END
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ==============================-->
@endsection
@push('scripts')
    <script>
        function updateQtyBasedOnRowId(value, rowId) {
            let qtyInput = $('.qty-' + rowId); // Select the input element using its class
            let qty = parseInt(qtyInput.val(), 10); // Get the current quantity value as an integer

            if (isNaN(qty)) {
                alert('Invalid quantity');
                return;
            }

            if (value === 1) {
                // Increment the quantity
                qty++;
            } else if (value === -1 && qty > 1) {
                // Decrement the quantity only if it's greater than 1
                qty--;
            } else if (value === -1 && qty <= 1) {
                alert('Quantity cannot be less than 1');
                return;
            }

            // Update the input field with the new quantity
            qtyInput.val(qty);

            // Log the updated value for debugging
            console.log('Updated Quantity for Row ID ' + rowId + ':', qty);


            $.ajax({
                url: "{{ route('frontend.cart.updateQty') }}", // Your route for updating qty
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token
                    rowId: rowId,
                    qty: qty
                },
                success: function(response) {
                    if (response.status === 'success') {
                        // alert(response.message);     
                        console.log(response.updatedPrice);
                        let totalElm = '#total-' + response.rowId;
                        $(totalElm).text(response.updatedPrice);
                        calcTotal();

                    } else {
                        console.log(response.error);

                    }
                },
                error: function(xhr) {
                    console.log('Something went wrong!');
                }
            });
        }

        // Coupon 
        $('.coupon-form').on('submit', function(e) {
            e.preventDefault(); // Prevent form submission

            let coupon = $('.coupon').val(); // Serialize form data   
            let userId = "{{ Auth::user()->id }}";

            $.ajax({
                url: "{{ route('frontend.cart.coupon') }}", // Your route for updating qty
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token
                    coupon: coupon,
                    userId: userId,
                },
                success: function(response) {
                    if (response.status === 'success') {
                        // alert(response.message);     
                        console.log(response.coupon);
                        calcTotal();

                    } else {
                        console.log(response.error);
                    }
                },
                error: function(xhr) {
                    console.log('Something went wrong!');
                }
            });
        });

        // Calculate the cart total | cart sidebar 
        function calcTotal() {
            let cartTotla = $('.cart-total');
            let cartDiscount = $('.cart-discount');
            $.ajax({
                url: "{{ route('frontend.cart.calculateTotal') }}", // Your route for updating qty
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr(
                        'content'), // CSRF token                        
                },
                success: function(response) {
                    // back to here
                    // console.log(response);
                    cartTotla.text(response.total);
                    cartDiscount.text(response.discount);
                },
                error: function(xhr) {
                    console.log('Something went wrong!');
                }
            });
        }

        calcTotal();
    </script>
@endpush
