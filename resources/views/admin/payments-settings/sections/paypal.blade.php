<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
    <div class="row">
        <div class="col-12 ">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.paymentpaypal.update', 1) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">

                            <div class="col-md-12">
                                <label for="">Status</label>
                                <select name="status" class="form-control">
                                    <option value="1"
                                        {{ old('status', $paypal->status ?? '') == '1' ? 'selected' : '' }}>Enable
                                    </option>
                                    <option value="0"
                                        {{ old('status', $paypal->status ?? '') == '0' ? 'selected' : '' }}>Disable
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label for="">Account Mode</label>
                                <select name="layout" class="form-control">
                                    <option value="0"
                                        {{ old('layout', $paypal->layout ?? '') == '0' ? 'selected' : '' }}>Sandbox
                                    </option>
                                    <option value="1"
                                        {{ old('layout', $paypal->layout ?? '') == '1' ? 'selected' : '' }}>Live
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label for="">Country</label>
                                <select name="country" class="form-control">
                                    @foreach (config('settings.countries') as $country => $city)
                                        <option value="{{ $country }}"
                                            {{ old('country', $paypal->country ?? '') == $country ? 'selected' : '' }}>
                                            {{ $country }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label for="">Currency Name</label>
                                <select name="currency_name" class="form-control">
                                    @foreach (config('settings.currencies') as $currency)
                                        <option value="{{ $currency['name'] }}"
                                            {{ old('courncy_name', $paypal->courncy_name ?? '') == $currency['name'] ? 'selected' : '' }}>
                                            {{ $currency['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Currency Rate <code>(USD)</code></label>
                                    <input type="text" class="form-control" name="currency_rate"
                                        value="{{ old('currency_rate', $paypal->currency_rate ?? '') }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Paypal User ID</label>
                                    <input type="text" class="form-control" name="user_id"
                                        value="{{ old('user_id', $paypal->user_id ?? '') }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Paypal Secret Key</label>
                                    <input type="text" class="form-control" name="secret_key"
                                        value="{{ $paypal->secret_key }}">
                                </div>
                            </div>

                        </div>

                        <div class="form-group col-2 my-5 mx-auto">
                            <input type="submit" class="btn btn-primary form-control" value="update">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
