@extends($activeTemplate.'layouts.frontend')
@section('content')
@php
    $banner = getContent('banner.content', true);//this is a helper function //goto app/Http/Helpers
@endphp
@push('style')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<style>
    .dropdown-toggle{
        height: 40px;
        width: 400px !important;
    }
</style>
@endpush
@if(auth()->user())
    @if (!$hasDemographics)
    <div class="row gy-4">
        <form action="{{ route('demographics.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="income">Income:</label>
                <input type="number" name="income" id="income" class="form-control" required>
            </div>
        
            <div class="form-group">
                <label for="family_size">Family Size:</label>
                <input type="number" name="family_size" id="family_size" class="form-control" required>
            </div>
        
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select name="gender" id="gender" class="form-control" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
        
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    @endif

    @if (!$hasPreferences)
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background: gray; color:#f1f7fa; font-weight:bold;">
                    Select 3 Categories
                </div>
                    <div class="card-body">
                    @php
                        $preferences = [
                            'Hot Spring',
                            'Fish Feeding',
                            'Beach',
                            'Parking',
                            'Island Hopping',
                            'Forest',
                            'Boat'
                        ];
                    @endphp                    
                    <form id="preferencesForm" class="w-px-500 p-3 p-md-3" action="{{ route('preferences.store') }}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Preferences</label>
                            <div class="col-sm-9 mt-3">
                                <select name="preferences[]" id="preferences" multiple required>
                                    @foreach ($preferences as $item)
                                        <option value="{{ $item }}">
                                            {{ $item }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-success text-white">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    @push('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script>
        $('select').selectpicker();
    </script>
    @endpush
    @endif
@endif

@if(session('demographics-success'))
    <div class="alert alert-success">
        {{ session('demographics-success') }}
    </div>
@endif

@if(session('preferences-success'))
    <div class="alert alert-success">
        {{ session('preferences-success') }}
    </div>
@endif

@if ($recommendedProperties)
    <div class="best-trip-slider">
        @foreach ($recommendedProperties as $property)
        <div class="single-slide">
            <div class="best-trip-card">
            @if ($property->discount != 0)
                <div class="best-trip-card__badge">
                    <b>{{ showAmount($property->discount) }}%</b> <br>
                    <span>@lang('off')</span>
                </div>
            @endif
            <div class="thumb">
                <img src="{{ getImage(imagePath()['property']['path'].'/'. $property->image, imagePath()['property']['size']) }}" alt="image">
            </div>
            <div class="content">
                <div class="top">
                <div class="ratings">
                    @for ($i = 0; $i < round($property->rating); $i++)
                    <i class="las la-star"></i>
                    @endfor
                    <span class="fs--14px">({{ $property->review }})</span>
                </div>
                <h4 class="name">{{ __($property->name) }}</h4>
                <span class="fs--14px mt-2"><i class="las la-map-marked-alt fs--18px"></i> @lang('in') {{ __($property->location->name) }}</span>
                </div>
                <div class="bottom d-flex align-items-center">
                <div class="col-6">
                    <div class="price text--base">
                    @php
                        $lowestPrice = $property->rooms[0]->price;
                        foreach ($property->rooms as $room) {
                            if($room->price < $lowestPrice){
                            $lowestPrice = $room->price;
                            }
                        }
                        echo $general->cur_sym.showAmount($lowestPrice);
                    @endphp
                    </div>
                    <span class="fs--14px">@lang('Per night')</span>
                </div>
                <div class="col-6 text-end">
                    <a href="{{ route('property', [$property->id, slug($property->name)]) }}" class="btn btn-sm btn--base">@lang('View Details')</a>
                </div>
                </div>
            </div>
            </div><!-- best-trip-card end -->
        </div><!-- single-slide end -->
        @endforeach
    </div>
@endif

<section class="hero bg_img" style="background-image: url('{{ getImage('assets/images/frontend/banner/'.$banner->data_values->background_image, '1920x1195') }}');">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-6 col-lg-8 text-center">
                <h2 class="hero__title text-white wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s">{{ __($banner->data_values->heading) }}</h2>
                <p class="hero__description text-white mt-3 wow fadeInUp" data-wow-duration="0.5s"
                    data-wow-delay="0.5s">{{ __($banner->data_values->sub_heading) }}</p>
            </div>
            <div class="col-xxl-10 mt-5 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.7s">
                <div class="hero-search-area rounded-3">
                    <form action="{{ route('property.search') }}" class="hero-search-form">
                        <div class="row gy-3 align-items-center">
                            <div class="col-xl-3 col-lg-3 col-sm-6">
                                <label>@lang('Location')</label>
                                <div class="input-group border px-2 radius-5">
                                    <span class="input-group-text"><i class="las la-map-marker"></i></span>
                                    <select class="select2-basic" name="location" id="location">
                                        <option value="">@lang('Select One')</option>
                                        @foreach ($locations as $location)
                                        <option value="{{ $location->id }}" @if(old('location') == $location->id) selected="selected" @endif>{{ __($location->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-sm-6">
                                <label>@lang('Checkin - Checkout')</label>
                                <div class="input-group border px-2 radius-5">
                                    <span class="input-group-text"><i class="las la-calendar-check"></i></span>
                                    <input type="text" data-range="true" name="date" data-multiple-dates-separator=" - "
                                        data-language="en" class="datepicker-here form--control" id="date"
                                        placeholder="Checkin & Checkout" autocomplete="off" value="{{ old('date') }}">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-sm-6">
                                <label>@lang('Adult')</label>
                                <div class="input-group border px-2 radius-5">
                                    <span class="input-group-text"><i class="las la-user"></i></span>
                                    <input type="number" name="adult" autocomplete="off" value="{{ old('adult') ? old('adult') : 1 }}" min="1" id="adult" class="form--control">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-sm-6">
                                <label>@lang('Child')</label>
                                <div class="input-group border px-2 radius-5">
                                    <span class="input-group-text"><i class="las la-child"></i></span>
                                    <input type="number" name="child" autocomplete="off" value="{{ old('child') ? old('child') : 0 }}" min="0" id="child" class="form--control">
                                </div>
                            </div>
                            <div class="col-lg-2 text-end align-self-end">
                                <button type="submit" class="btn btn--base w-100">@lang('Search')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- hero section end -->


@if($sections->secs != null)
    @foreach(json_decode($sections->secs) as $sec)
        @include($activeTemplate.'sections.'.$sec)
    @endforeach
@endif
@endsection
