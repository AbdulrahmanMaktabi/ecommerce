@extends('frontend.layouts.master')
@section('title', "{{ $generalSettings->site_name }}. payment")
@section('content')
    {{-- Start Payment Page --}}
    <section id="wsus__cart_view">
        <div class="container">
            <div class="wsus__pay_info_area">
                <div class="row">
                    <div class="col-xl-3 col-lg-3">
                        <div class="wsus__payment_menu" id="sticky_sidebar">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                {{-- Paypal Button --}}
                                <button class="nav-link common_btn" id="v-pills-paypal-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-paypal" type="button" role="tab"
                                    aria-controls="v-pills-paypal" aria-selected="true">paypal</button>

                                {{-- Stripe Button --}}
                                <button class="nav-link common_btn" id="v-pills-stripe-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-stripe" type="button" role="tab"
                                    aria-controls="v-pills-stripe" aria-selected="true">Stripe</button>

                                {{-- cash on delivery Button --}}
                                <button class="nav-link common_btn" id="v-pills-settings-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-settings" type="button" role="tab"
                                    aria-controls="v-pills-settings" aria-selected="false">cash on delivery</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5">
                        <div class="tab-content" id="v-pills-tabContent" id="sticky_sidebar">
                            {{-- Start Paypal --}}
                            <div class="tab-pane fade show active" id="v-pills-paypal" role="tabpanel"
                                aria-labelledby="v-pills-paypal-tab">
                                <div class="row">
                                    <div class="col-xl-12 m-auto">
                                        <div class="wsus__payment_area">
                                            <form>
                                                <button type="submit" class="common_btn">Pay With Paypal</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End Paypal --}}

                            {{-- Start Stripe --}}
                            <div class="tab-pane fade" id="v-pills-stripe" role="tabpanel"
                                aria-labelledby="v-pills-stripe-tab">
                                <div class="row">
                                    <div class="col-xl-12 m-auto">
                                        <div class="wsus__payment_area">
                                            <form>
                                                <div class="wsus__pay_caed_header">
                                                    <h5>credit or debit card</h5>
                                                    <img src="{{ asset('frontend/assets/images') }}/payment5.png"
                                                        alt="payment" class="img-=fluid">
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <input class="input" type="text"
                                                            placeholder="MD. MAHAMUDUL HASSAN SAZAL">
                                                    </div>
                                                    <div class="col-12">
                                                        <input class="input" type="text"
                                                            placeholder="2540 4587 **** 3215">
                                                    </div>
                                                    <div class="col-4">
                                                        <input class="input" type="text" placeholder="MM/YY">
                                                    </div>
                                                    <div class="col-4 ms-auto">
                                                        <input class="input" type="text" placeholder="1234">
                                                    </div>
                                                </div>
                                                <div class="wsus__save_payment">
                                                    <h6><i class="fas fa-user-lock"></i> 100% secure payment with :</h6>
                                                    <img src="{{ asset('frontend/assets/images') }}/payment1.png"
                                                        alt="payment" class="img-fluid">
                                                    <img src="{{ asset('frontend/assets/images') }}/payment2.png"
                                                        alt="payment" class="img-fluid">
                                                    <img src="{{ asset('frontend/assets/images') }}/payment3.png"
                                                        alt="payment" class="img-fluid">
                                                </div>
                                                <div class="wsus__save_card">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="flexSwitchCheckDefault">
                                                        <label class="form-check-label" for="flexSwitchCheckDefault">save
                                                            thid Card</label>
                                                    </div>
                                                </div>
                                                <button type="submit" class="common_btn">confirm</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End Paypal --}}

                            {{-- Start cash on delivery --}}
                            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                                aria-labelledby="v-pills-settings-tab">
                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Libero, tempora cum optio
                                    cumque rerum dolor impedit exercitationem? Eveniet suscipit repellat, quae natus hic
                                    assumenda consequatur excepturi ducimus.</p>
                                <ul>
                                    <li>Natus hic assumenda consequatur excepturi ducimu.</li>
                                    <li>Cumque rerum dolor impedit exercitationem Eveniet suscipit repellat.</li>
                                    <li>Dolor sit amet consectetur adipisicing elit tempora cum .</li>
                                    <li>Orem ipsum dolor sit amet consectetur adipisicing elit asperiores.</li>
                                </ul>
                                <form class="wsus__input_area">
                                    <input type="text" placeholder="Enter Something">
                                    <textarea cols="3" rows="4" placeholder="Enter Something"></textarea>
                                    <select class="select_2" name="state">
                                        <option>default select</option>
                                        <option>short by rating</option>
                                        <option>short by latest</option>
                                        <option>low to high </option>
                                        <option>high to low</option>
                                    </select>
                                    <button type="submit" class="common_btn mt-4">confirm</button>
                                </form>
                            </div>
                            {{-- End cash on delivery --}}
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4">
                        <div class="wsus__pay_booking_summary" id="sticky_sidebar2">
                            <h5>Booking Summary</h5>
                            <p>subtotal: <span>{{ $generalSettings->currency_icon . getSubTotalCartAmount() }}</span></p>
                            <p>shipping fee:
                                <span>
                                    {{ $generalSettings->currency_icon }}
                                    {{ getShippingPrice() }}
                                </span>
                            </p>
                            <h6>total <span>
                                    {{ $generalSettings->currency_icon }}
                                    <span class="cart-total"></span>
                                </span></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- End Payment Page --}}
@endsection
@push('scripts')
    <script>
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
                    console.log(response);
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
