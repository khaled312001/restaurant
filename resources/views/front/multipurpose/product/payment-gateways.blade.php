{{-- Online gateways disabled on request --}}


{{-- Stripe disabled --}}



{{-- Paystack disabled --}}




{{-- Flutterwave disabled --}}



{{-- Razorpay disabled --}}



{{-- Instamojo disabled --}}



{{-- Paytm disabled --}}



{{-- Start: PayUmoney Area --}}
{{-- @if ($payumoney->status == 1)
<div class="option-block">
    <div class="checkbox">
        <label>
            <input name="gateway" class="input-check" type="radio" value="payumoney" data-tabid="payumoney" data-action="{{route('product.payumoney.submit')}}">
            <span>{{__('PayUmoney')}}</span>
        </label>
    </div>
</div>


<div class="row gateway-details" id="tab-payumoney">

    <div class="col-lg-6 mb-4">
        <div class="field-input">
            <input class="card-elements mb-0" name="payumoney_first_name" type="text" placeholder="{{ __('First Name') }}" value="{{old('payumoney_first_name')}}" />
        </div>
        @if ($errors->has('payumoney_first_name'))
            <p class="text-danger mb-0">{{$errors->first('payumoney_first_name')}}</p>
        @endif
    </div>

    <div class="col-lg-6 mb-4">
        <div class="field-input">
            <input class="card-elements mb-0" name="payumoney_last_name" type="text" placeholder="{{ __('Last Name') }}" value="{{old('payumoney_last_name')}}" />
        </div>
        @if ($errors->has('payumoney_last_name'))
            <p class="text-danger mb-0">{{$errors->first('payumoney_last_name')}}</p>
        @endif
    </div>

    <div class="col-lg-6 mb-4">
        <div class="field-input">
            <input class="card-elements mb-0" name="payumoney_phone" type="text" placeholder="{{ __('Phone') }}" value="{{old('payumoney_phone')}}"  />
        </div>
        @if ($errors->has('payumoney_phone'))
            <p class="text-danger mb-0">{{$errors->first('payumoney_phone')}}</p>
        @endif
    </div>
</div>
@endif --}}
{{-- End: PayUmoney Area --}}





{{-- Mollie disabled --}}




{{-- Mercadopago disabled --}}



{{-- Start: Offline Gateways Area --}}
@foreach ($ogateways as $ogateway)
    <div class="offline" id="offline{{$ogateway->id}}">
        <div class="option-block">
            <div class="checkbox">
                <label>
                <input name="gateway" class="input-check" type="radio" value="{{$ogateway->id}}" data-tabid="{{$ogateway->id}}" data-action="{{route('product.offline.submit', $ogateway->id)}}">
                    <span>{{$ogateway->name}}</span>
                </label>
            </div>
        </div>

        @if (!empty($ogateway->short_description))
        
            <p class="gateway-desc">{!! nl2br(replaceBaseUrl(convertUtf8($ogateway->short_description))) !!}</p>
        @endif

        <div class="gateway-details row" id="tab-{{$ogateway->id}}">
            @if (!empty(strip_tags($ogateway->instructions)))
                <div class="col-12">
                    <div class="gateway-instruction">
                        {!! nl2br(replaceBaseUrl(convertUtf8($ogateway->instructions))) !!}
                    </div>
                </div>
            @endif

            @if ($ogateway->is_receipt == 1)
                <div class="col-12 mb-4">
                    <label for="receipt_{{ $ogateway->id }}" class="d-block">{{__('Receipt')}} **</label>
                    <input type="file" name="receipt" id="receipt_{{ $ogateway->id }}" accept=".jpg,.jpeg,.png" class="form-control">
                    <p class="mb-0 text-warning">** {{__('Receipt image must be .jpg / .jpeg / .png')}}</p>
                </div>
            @endif
        </div>
    </div>
@endforeach


@if ($errors->has('receipt'))
    <p class="text-danger mb-4">{{$errors->first('receipt')}}</p>
@endif
{{-- End: Offline Gateways Area --}}

