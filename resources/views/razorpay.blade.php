@extends('layouts.app')

@section('content')
    <h4>Create Razorpay Order</h4>

    @if(session('response'))
        <div class="alert alert-info">
            <pre>{{ json_encode(session('response'), JSON_PRETTY_PRINT) }}</pre>
        </div>
    @endif

    <form method="POST" action="{{ route('web.razorpay.order') }}">
        @csrf
        <div class="mb-3">
            <label>Amount (INR):</label>
            <input name="amount" type="number" class="form-control" required>
        </div>
        <button class="btn btn-dark">Create Razorpay Order</button>
    </form>
@endsection
