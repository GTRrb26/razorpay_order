@extends('layouts.app')

@section('content')
    <h4>Place Order</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('web.orders.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Name:</label>
            <input name="customer_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email:</label>
            <input name="customer_email" type="email" class="form-control" required>
        </div>

        <h5>Select Products</h5>
        @foreach ($products as $product)
            <div class="mb-2">
                <label>{{ $product->name }} (₹{{ $product->price }}) - Stock: {{ $product->stock }}</label>
                <input type="number" name="products[{{ $product->id }}]" min="0" max="{{ $product->stock }}" class="form-control" placeholder="Quantity">
            </div>
        @endforeach

        <button class="btn btn-primary mt-3">Submit Order</button>
    </form>
@endsection
