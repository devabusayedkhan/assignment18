@extends('layouts.app')

@section('content')

<div class="form-card">
    <h2>Edit Product</h2>

    @if($errors->any())
        <div class="alert-error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/products/{{ $product->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="product_id">Product ID</label>
        <input type="text" name="product_id" id="product_id" value="{{ old('product_id', $product->product_id) }}" required>

        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required>

        <label for="description">Description</label>
        <textarea name="description" id="description">{{ old('description', $product->description) }}</textarea>

        <label for="price">Price</label>
        <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" step="0.01" required>

        <label for="stock">Stock</label>
        <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}">

        <label for="image">Product Image</label>
        <input type="file" name="image" id="image">
        @if($product->image)
            <p>Current Image: <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="max-width:150px; margin-top:10px; border-radius:5px;"></p>
        @endif

        <button type="submit">Update Product</button>
    </form>

    <a href="/products" class="btn-back">Back to Products</a>
</div>
@endsection
