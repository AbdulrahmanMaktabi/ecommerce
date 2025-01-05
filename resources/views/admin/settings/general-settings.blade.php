@php
    use Carbon\Carbon;
@endphp
<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
    <div class="row">
        <div class="col-12 ">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.settings.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Store Name</label>
                                    <input type="text" class="form-control" name="store_name"
                                        value="{{ $settings->site_name }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Contact Email</label>
                                    <input type="text" class="form-control" name="contact_email"
                                        value="{{ $settings->contact_email }}">
                                </div>
                            </div>
                            <div class="col-md-12"> <label for="">Layout</label>
                                <select name="layout" id="" class="form-control">
                                    <option value="ltr" {{ $settings->layout == 'ltr' ? 'selected' : '' }}>LTR
                                    </option>
                                    <option value="rtl" {{ $settings->layout == 'ltr' ? '' : 'selected' }}>RTL
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-12"> <label for="">Default Currency Name</label>
                                <select name="currency_name" id="" class="form-control">
                                    @foreach (config('settings.currencies') as $item)
                                        <option value="{{ $item['name'] }}"
                                            {{ $settings->currency_name == $item['name'] ? 'selected' : '' }}>
                                            {{ $item['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12"> <label for="">Currecny Icon</label>
                                {{-- @dd($settings->currency_icon) --}}
                                <select name="currency_icon" id="" class="form-control">
                                    @foreach (config('settings.currencies') as $item)
                                        <option value="{{ $item['symbol'] }}"
                                            {{ $settings->currency_icon == $item['symbol'] ? 'selected' : '' }}>
                                            {{ $item['symbol'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="timezone">Timezone</label>
                                <select name="timezone" id="timezone" class="form-control">
                                    @foreach (config('settings.timezones') as $region)
                                        <optgroup label="{{ $region['name'] }}">
                                            @foreach ($region['value'] as $timezone)
                                                <option value="{{ $timezone }}"
                                                    {{ $settings->timezone == $timezone ? 'selected' : '' }}>
                                                    {{ $timezone }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
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
