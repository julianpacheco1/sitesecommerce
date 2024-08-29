@extends('theme.layout')

@section('titulo')
    {{ __('Product Page Details') }}
@endsection


@section('contenido')
    <div class="container">
      <div class="pt-5">
        <h1 class="text-center text-light">¡Congratulations!</h1>
        <h2 class="text-center text-light">Product details:</h2> 
      </div>
        <div class="pt-5">
            <table class="table table-success table-striped">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Currency</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Image</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product['product_name'] }}</td>
                            <td>{{ number_format($product['amount'] / 100, 2) }}</td>
                            <td>{{ $product['currency'] }}</td>
                            <td>{{ $product['quantity'] }}</td>
                            <td>
                                <img src="{{ $product['product_image'] }}" alt="{{ $product['product_name'] }}"
                                    style="width: 50px; height: auto;">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
          </div>
        </div>
@endsection
