@extends($activeTemplate.'layouts.frontend')
@section('content')
<section class="pt-100 pb-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-6 col-md-8">
                <div class="custom--card card-deposit text-center">
                    <div class="card-body card-body-deposit">
                        <ul class="list-group text-center">
                            <li class="list-group-item img_list pb-4">
                                <img src="{{ 'https://i.seadn.io/gae/2hDpuTi-0AMKvoZJGd-yKWvK4tKdQr_kLIpB_qSeMau2TNGCNidAosMEvrEXFO9G6tmlFlPQplpwiqirgrIPWnCKMvElaYgI-HiVvXc?auto=format&dpr=1&w=1000' }}" alt="@lang('Image')" class="w-50" />
                            </li>
                            <p class="list-group-item d-flex justify-content-between">
                                @lang('Amount'):
                                <strong>{{1}} {{__('xd')}}</strong>
                            </p>
                            <p class="list-group-item d-flex justify-content-between">
                                @lang('Charge'):
                                <strong>{{1}} {{__('xd')}}</strong>
                            </p>
                            <p class="list-group-item d-flex justify-content-between">
                                @lang('Payable'): <strong> {{1}} {{__('xd')}}</strong>
                            </p>
                            <p class="list-group-item d-flex justify-content-between">
                                @lang('Conversion Rate'): <strong>1 {{__('xd')}} = {{1}}  {{__('xd')}}</strong>
                            </p>
                            <p class="list-group-item d-flex justify-content-between">
                                @lang('In') {{'xd'}}:
                                <strong>{{1}}</strong>
                            </p>
                            @if(true)
                                <p class="list-group-item">
                                    @lang('Conversion with')
                                    <b> {{ __('xd') }}</b> @lang('and final value will Show on next step')
                                </p>
                            @endif
                        </ul>

                        @if(true)
                            <a href="{{route('user.deposit.confirm')}}" class="btn btn--base d-block py-3 font-weight-bold mt-3">@lang('Pay Now')</a>
                        @else
                            <a href="{{route('user.deposit.manual.confirm')}}" class="btn btn--base d-block py-3 font-weight-bold mt-3">@lang('Pay Now')</a>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection

@push('style')
    <style>
        .list-group-item{
            border-left: none;
            border-right: none;
        }
        .img_list{
            border-top: none;
            margin-bottom:
        }
    </style>
@endpush


