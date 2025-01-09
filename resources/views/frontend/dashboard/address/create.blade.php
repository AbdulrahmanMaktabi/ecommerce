@extends('frontend.dashboard.layouts.master')
@section('title', $generalSettings->site_name . ' - Address ')

@section('content')
    <h3><i class="fal fa-gift-card"></i>create address</h3>
    <div class="wsus__dashboard_add wsus__add_address">
        <form method="POST" action="{{ route('address.store') }}">
            @csrf
            <div class="row">
                <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                        <label>name <b>*</b></label>
                        <input type="text" placeholder="Name" name="name" value="{{ @old('name') }}">
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                        <label>email</label>
                        <input type="email" placeholder="Email" name="email" value="{{ @old('email') }}">
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                        <label>phone <b>*</b></label>
                        <input type="text" placeholder="Phone" name="phone" value="{{ @old('phone') }}">
                    </div>
                </div>

                <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                        <label>Country <b>*</b></label>
                        <div class="wsus__topbar_select">
                            <select class="select_2" name="country" id="country">
                                <option value="">Select Country</option>
                                @foreach ($countries as $key => $cities)
                                    <option value="{{ $key }}">{{ $key }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                        <label>City <b>*</b></label>
                        <div class="wsus__topbar_select">
                            <select class="select_2" name="city" id="city">
                                <option value="">Select City</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                        <label>zip code <b>*</b></label>
                        <input type="text" placeholder="Zip Code" name="zipcode" value="{{ @old('zipcode') }}">
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                        <label>address type <b>*</b></label>
                        <input type="text" placeholder="Home / Work / others" name="address_type"
                            value="{{ @old('address_type') }}">
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="wsus__add_address_single">
                        <label>address</label>
                        <textarea cols="3" rows="5" placeholder="Type Your Address" name="address">{{ @old('address') }}"</textarea>
                    </div>
                </div>
                <div class="col-xl-6">
                    <button type="submit" class="common_btn">create</button>
                </div>
            </div>
        </form>
    </div>

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
        </script>
    @endpush
@endsection
