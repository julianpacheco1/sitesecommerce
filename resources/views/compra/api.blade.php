@extends('theme.layout')

@section('titulo')
    {{ __('Version en Api') }}
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/payment.css') }}">
    <style>
    .btn-buy-all {
        position: fixed;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100%;
        z-index: 5; 
        padding: 1rem;
    }


    .btn-buy:hover{
        background: #1a71c8;
        color: black;
    }
    </style>
@endpush


@section('contenido')
    <div class="row pb-5">
        @foreach ($products as $product)
            <div class="col-lg-4 col-md-6 p-5">
                <div class="card h-100">
                    <img src="{{ $product->image }}" class="card-img-top" style="max-width: 100%; height: auto;"
                        alt="{{ $product->name }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->price }}</p>
                        <div class="mt-auto">
                            <form action="{{ route('stripe.checkout.single', ['id' => $product->id]) }}" method="POST">
                                @csrf
                                <button class="btn-buy" type="submit">Comprar</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        @endforeach
    </div>

    <div class="row">
        <form action="{{ route('stripe.checkout.all') }}" method="POST">
            @csrf
            <button class="btn-buy-all btn-buy">Comprar Todos</button>
        </form>
    </div>
@endsection
