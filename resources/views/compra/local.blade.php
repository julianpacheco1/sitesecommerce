@extends('theme.layout')

@section('titulo')
    {{ __('Version en local') }}
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/payment.css') }}">
@endpush

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripeKey = "{{ env('STRIPE_KEY') }}";
    </script>
    <script src="{{ asset('assets/js/products/versionlocal/payment.js') }}" type="text/javascript"></script>
@endpush

@section('contenido')
    <div class="row">
        @foreach ($products as $product)
            <div class="col-lg-4 col-md-6 p-5">
                <div class="card h-100">
                    <img src="{{ $product->image }}" class="card-img-top" style="max-width: 100%; height: auto;"
                        alt="{{ $product->name }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->price }}</p>
                        <div class="mt-auto">
                            <button type="button" id="show-button-form" data-product-id="{{ $product->id }}">{{ __('Buy Now') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div id="payment-form-container" class="hidden"
        style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; padding: 2rem; border: 1px solid #ddd; z-index: 1000; width: 80%; max-width: 600px;">
        <div class="payment-price pb-3 fs-3"></div>
        <div id="payment-element"></div>
        <div>
            <button id="submit-button" class="">{{ __('Pay now') }}</button>
        </div>
        <div id="payment-message" class="hidden"></div>
        <div class="pt-4">
            <button class="close-button-form" type="button">{{ __('Close') }}</button>
        </div>
    </div>
@endsection
