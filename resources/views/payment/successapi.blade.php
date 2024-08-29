@extends('theme.layout')

@section('titulo')
    {{ __('Card Page Details') }}
@endsection


@section('contenido')
    <div class="container">
      <div class="pt-5">
        <h1 class="text-center text-light">¡Congratulations!</h1>
        <h2 class="text-center text-light">Customer and card details:</h2> 
      </div>
        <div class="pt-5">
            <table class="table table-success table-striped">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Currency</th>
                        <th scope="col">Country</th>
                        <th scope="col">Email</th>
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
