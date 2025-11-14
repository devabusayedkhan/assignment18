@extends('layouts.app')

@section('content')
    <div class="product-card">
        <div class="product-header">
            <h2>{{ $product->name }}</h2>
            <span class="product-id">ID: {{ $product->product_id }}</span>
        </div>

        @if($product->image)
            <div class="product-image">
                <img src="{{ asset( $product->image) }}" alt="{{ $product->name }}">
            </div>
        @endif


        <div class="product-details">
            <p><span class="label">Price:</span> ${{ number_format($product->price, 2) }}</p>
            <p><span class="label">Stock:</span> {{ $product->stock ?? '-' }}</p>
            <p><span class="label">Description:</span> {{ $product->description ?? 'No description available.' }}</p>
        </div>

        <a href="/products" class="btn-back">← Back to Products</a>
    </div>
@endsection