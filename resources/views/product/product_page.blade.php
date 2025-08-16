@extends('layouts.master')

@section('content')
<div class="container mt-5">
    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">Product</h4>
                <a href="{{ route('productCreate') }}" class="btn" style="background-color: #800080; color: white;">CREATE</a>
            </div>

            <table class="table table-bordered table-hover text-center">
                <thead class="table-light">
                    <tr>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Unit</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse($products as $product)
                    <tr>
                        <td>
                            <img src="{{ asset($product->img_url) }}" alt="Product Image" width="80" height="100">
                        </td>
                        <td>{{ $product->product_name }}</td>
                        <td>${{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->unit }}</td>
                        <td>
                            <a href="{{route('productId',$product->id)}}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{route('product.destroy',$product->id)}}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">No products found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
