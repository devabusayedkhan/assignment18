@extends('layouts.app')

@section('content')

<div class="form-card">
    <h2>Create New Product</h2>

    @if($errors->any())
        <div class="alert-error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/products" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="product_id">Product ID</label>
        <input type="text" name="product_id" id="product_id" value="{{ old('product_id') }}" required>

        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>

        <label for="description">Description</label>
        <textarea name="description" id="description">{{ old('description') }}</textarea>

        <label for="price">Price</label>
        <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" required>

        <label for="stock">Stock</label>
        <input type="number" name="stock" id="stock" value="{{ old('stock') }}">

        <label for="image">Product Image</label>
        <input type="file" name="image" id="image" required>

        <button type="submit">Create Product</button>
    </form>

    <a href="/products" class="btn-back">Back to Products</a>
</div>
@endsection
