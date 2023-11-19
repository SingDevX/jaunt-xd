@extends($activeTemplate.'layouts.frontend')
@section('content')
    <section class="pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                    <div class="custom--card card-deposit">
                        <h5 class="card-header text-center">{{__('Manual Payment')}}
                        </h5>
                        <div class="card-body card-body-deposit">
                            <img src="{{'https://i.seadn.io/gae/2hDpuTi-0AMKvoZJGd-yKWvK4tKdQr_kLIpB_qSeMau2TNGCNidAosMEvrEXFO9G6tmlFlPQplpwiqirgrIPWnCKMvElaYgI-HiVvXc?auto=format&dpr=1&w=1000'}}" class="card-img-top" alt="{{__('Manual Payment')}}" class="w-100">
                        </div>
                        <div class="card-footer">
                            <form action="{{route('user.deposit.insert')}}" method="post">
                                @csrf
                                <p class="text-danger depositLimit"></p>
                                <p class="text-danger depositCharge"></p>
                                <div class="form-group">
                                    <input type="hidden" name="currency"  value="{{'Currency 1'}}">
                                    <input type="hidden" name="method_code" value="{{'Code 1'}}">
                                </div>

                                <div class="prevent-double-click">
                                    <button type="submit" class="btn w-100 btn--base d-block custom-success deposit confirm-btn">@lang('Pay Now')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @foreach($gatewayCurrency as $data)
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                        <div class="custom--card card-deposit">
                            <h5 class="card-header text-center">{{__($data->name)}}
                            </h5>
                            <div class="card-body card-body-deposit">
                                <img src="{{$data->methodImage()}}" class="card-img-top" alt="{{__($data->name)}}" class="w-100">
                            </div>
                            <div class="card-footer">
                                <form action="{{route('user.deposit.insert')}}" method="post">
                                    @csrf
                                    <p class="text-danger depositLimit"></p>
                                    <p class="text-danger depositCharge"></p>
                                    <div class="form-group">
                                        <input type="hidden" name="currency"  value="{{$data->currency}}">
                                        <input type="hidden" name="method_code" value="{{$data->method_code}}">
                                    </div>

                                    <div class="prevent-double-click">
                                        <button type="submit" class="btn w-100 btn--base d-block custom-success deposit confirm-btn">@lang('Pay Now')</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
