@extends('frontend.dashboard.layouts.master')
@section('title', $generalSettings->site_name . ' - Address ')
@section('content')
    <h3><i class="fal fa-gift-card"></i> address</h3>
    <div class="wsus__dashboard_add">
        <div class="row">
            @if (isset($addresses))
                @foreach ($addresses as $address)
                    <div class="col-xl-6">
                        <div class="wsus__dash_add_single">
                            <h4>{{ $address->name }} <span>{{ $address->address_type }}</span></h4>
                            <ul>
                                <li><span>name :</span> {{ Auth::user()->name }}</li>
                                <li><span>Phone :</span> +{{ $address->phone }}</li>
                                <li><span>email :</span> {{ $address->email }}</li>
                                <li><span>country :</span> {{ $address->country }}</li>
                                <li><span>city :</span> {{ $address->city }}</li>
                                <li><span>zip code :</span> {{ $address->zipcode }}</li>
                                <li><span>address :</span> {{ $address->address }}</li>
                            </ul>
                            <div class="wsus__address_btn">
                                <a href="{{ route('address.edit', ['addressID' => $address->id]) }}" class="edit"><i
                                        class="fal fa-edit"></i> edit</a>
                                <a href="{{ route('address.destroy', ['addressID' => $address->id]) }}"
                                    class="del delete-item"><i class="fal fa-trash-alt"></i> delete</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <h1>test</h1>
            @endif

            <div class="col-12">
                <a href="{{ route('address.create') }}" class="add_address_btn common_btn"><i class="far fa-plus"></i>
                    add new address</a>
            </div>
        </div>
    </div>
@endsection
