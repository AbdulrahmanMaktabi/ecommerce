@extends('frontend.layouts.master')
@section('title', "{{ $generalSettings->site_name }}. checkout")
@section('content')

    {{-- CHECK OUT PAGE START --}}
    <form class="wsus__checkout_form" method="POST" action="{{ route('checkout.checkout') }}">
        <section id="wsus__cart_view">
            <div class="container">
                @csrf
                <div class="row">
                    {{-- Start Billing --}}
                    <div class="col-xl-8 col-lg-7">
                        <div class="wsus__check_form">
                            <h5>Billing Details
                            </h5>
                            <div class="row">
                                <div class="col-md-6 col-lg-12 col-xl-6">
                                    <div class="wsus__check_single_form">
                                        <input type="text" placeholder="First Name" name="first_name">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-12 col-xl-6">
                                    <div class="wsus__check_single_form">
                                        <input type="text" placeholder="Last Name" name="last_name">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <div class="wsus__check_single_form">
                                        <input type="text" placeholder="Company Name (Optional)" name="company">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-12 col-xl-6">
                                    <div class="wsus__check_single_form">
                                        <input type="text" placeholder="Phone *" name="phone">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-12 col-xl-6">
                                    <div class="wsus__check_single_form">
                                        <input type="email" placeholder="Email *" name="email">
                                    </div>
                                </div>

                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <div class="wsus__check_single_form">
                                        <h5>Additional Information</h5>
                                        <textarea cols="3" rows="4" placeholder="Notes about your order, e.g. special notes for delivery"
                                            name="additional_inforamtion"></textarea>
                                    </div>
                                </div>
                            </div>
                            @if (count(Auth::user()->addresses) > 0)
                                <div class="row">
                                    @foreach (Auth::user()->addresses as $address)
                                        <div class="col-xl-6">
                                            <div class="wsus__checkout_single_address">
                                                <div class="form-check">
                                                    <input class="form-check-input address" type="radio" name="address"
                                                        id="{{ $address->name }}" {{ $loop->first ? 'checked' : '' }}
                                                        value="{{ $address->name }}">
                                                    <label class="form-check-label" for="{{ $address->name }}">
                                                        Select Address
                                                    </label>
                                                </div>
                                                <ul>
                                                    <li><span>Name :</span>{{ $address->name }}</li>
                                                    <li><span>Phone :</span> {{ $address->phone }}</li>
                                                    <li><span>Email :</span> {{ $address->email }}</li>
                                                    <li><span>Country :</span> {{ $address->country }}</li>
                                                    <li><span>City :</span> {{ $address->city }}</li>
                                                    <li><span>Zip Code :</span> {{ $address->zipcode }}</li>
                                                    <li><span>Type :</span> {{ $address->address_type }}</li>
                                                    <li><span>Address :</span>{{ $address->address }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <h1>no</h1>
                            @endif
                        </div>
                    </div>
                    {{-- End Billing --}}

                    {{-- Start Sidebar --}}
                    <div class="col-xl-4 col-lg-5">
                        <div class="wsus__order_details" id="sticky_sidebar">
                            <p class="wsus__product">shipping Methods</p>
                            {{-- Start Shipping  --}}
                            @php
                                $shippingRule = getShippingRule(getSubTotalCartAmount());
                            @endphp
                            @if ($shippingRule)
                                @if (count($shippingRule) > 0)
                                    @foreach ($shippingRule as $sr)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="shippingRule"
                                                id="{{ $sr->name }}" {{ $loop->first ? 'checked' : '' }}
                                                value="{{ $sr->name }}">
                                            <label class="form-check-label" for="{{ $sr->name }}">
                                                {{ $sr->name }}
                                                <span>({{ $generalSettings->currency_icon . $sr->price }})
                                                    - {{ $sr->duration }}
                                                    days
                                                </span>
                                            </label>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="shippingRule"
                                            id="{{ $shippingRule->name }}" value="{{ $shippingRule->name }}" checked>
                                        <label class="form-check-label" for="{{ $shippingRule->name }}">
                                            {{ $shippingRule->name }}
                                            <span>({{ $generalSettings->currency_icon . $shippingRule->price }})</span>
                                        </label>
                                    </div>
                                @endif
                            @else
                                <div class="form-check">
                                    <label class="form-check-label" for="exampleRadios1">
                                        No Shipping Rules !!
                                    </label>
                                </div>
                            @endif
                            {{-- End Shipping  --}}
                            <div class="wsus__order_details_summery">
                                <p>subtotal: <span>{{ $generalSettings->currency_icon . getSubTotalCartAmount() }}</span>
                                </p>
                                <p>shipping fee:
                                    <span>
                                        {{-- {{ $generalSettings->currency_icon . $shippingRule->price ?? '0' }} --}}
                                    </span>
                                </p>
                                <p><b>total:</b>
                                    <span><b>
                                            {{ $generalSettings->currency_icon }}
                                            <span class="cart-total"></span>
                                        </b></span>
                                </p>
                            </div>
                            <div class="terms_area">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="flexCheckChecked3" checked
                                        name="rules">
                                    <label class="form-check-label" for="flexCheckChecked3">
                                        I have read and agree to the website <a href="#">terms and conditions *</a>
                                    </label>
                                </div>
                            </div>
                            <input class="common_btn" type="submit" value="Place Order">
                        </div>
                    </div>
                    {{-- End Sidebar --}}
                </div>
            </div>
        </section>

    </form>

    {{-- CHECK OUT PAGE END --}}
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#country').on('change', function() {
                let selectedCountry = $(this).val();
                let cityDropdown = $('#city');

                if (selectedCountry) {
                    $.ajax({
                        url: "{{ route('address.get-cities') }}", // Route to your controller
                        type: 'GET',
                        data: {
                            country: selectedCountry
                        },
                        success: function(response) {
                            cityDropdown.empty(); // Clear previous options
                            cityDropdown.append('<option value="">Select City</option>');

                            // Populate cities
                            response.forEach(function(city) {
                                cityDropdown.append('<option value="' + city + '">' +
                                    city + '</option>');
                            });
                        },
                        error: function() {
                            alert('Failed to fetch cities. Please try again.');
                        }
                    });
                } else {
                    cityDropdown.empty();
                    cityDropdown.append('<option value="">Select City</option>');
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
