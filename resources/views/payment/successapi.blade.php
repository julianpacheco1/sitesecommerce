@extends('theme.layout')

@section('titulo')
    {{ __('Card Page Details') }}
@endsection


@section('contenido')
    <div class="container">
      <div class="pt-5">
        <h1 class="text-center text-light">{{ __('¡Congratulations!') }}</h1>
        <h2 class="text-center text-light">{{ __('Customer and Card details:') }}</h2> 
      </div>
        <div class="pt-5">
            <table class="table table-success table-striped">
                <thead>
                    <tr>
                        <th scope="col">{{ __('Name') }}</th>
                        <th scope="col">{{ __('Price') }}</th>
                        <th scope="col">{{ __('Currency')  }}</th>
                        <th scope="col">{{ __('Country') }}</th>
                        <th scope="col">{{ __('Email') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $session->customer_details->name }}</td>
                        <td>{{ number_format($session->amount_total / 100, 2) }}</td>
                        <td>{{ $session->currency }}</td>
                        <td>{{ $session->customer_details->address->country }}</td>
                        <td>{{ $session->customer_details->email }}</td>
                    </tr>
                </tbody>
            </table>
          </div>
        </div>
@endsection
