@extends('theme.layout')

@section('titulo')
    {{ __('Inicio') }}
@endsection


@section('contenido')
    <div class="row min-vh-100 d-flex justify-content-center align-items-center bg-dark">
        <div class="col-12 col-md-8 col-lg-6 text-center">
            <div class="p-4 rounded">
                @if (Route::has('login'))
                    <div>
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-link text-secondary">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-link text-secondary fs-4">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-link text-secondary ms-3 fs-4">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
