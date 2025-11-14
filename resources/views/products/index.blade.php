@extends('layouts.app')

@section('content')

<div class="container">
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h1>All Products</h1>
        <a href="/products/create" class="btn btn-add">Add Product</a>
    </div>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th><th>Name</th><th>Price</th><th>Stock</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->product_id }}</td>
                <td><img style="width:50px; vertical-align: middle;" src="{{ asset( $product->image) }}" alt="{{ $product->name }}">{{ $product->name }}</td>
                <td>${{ number_format($product->price, 2) }}</td>
                <td>{{ $product->stock ?? '-' }}</td>
                <td>
                    <a href="/products/{{ $product->id }}" class="btn btn-view">View</a>
                    <a href="/products/{{ $product->id }}/edit" class="btn btn-edit">Edit</a>
                    <form action="/products/{{ $product->id }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination">
        {{ $products->links() }}
    </div>
</div>
@endsection
