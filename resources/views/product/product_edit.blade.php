@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Edit Product</h2>

    <form action="{{ route('productUpdate', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="category">Category</label>
            <select class="form-control" name="category_id" id="category" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" 
                        {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="product_name">Product Name</label>
            <input type="text" 
                   class="form-control" 
                   name="product_name" 
                   id="product_name" 
                   value="{{ $product->product_name }}" 
                   required>
        </div>

        <div class="form-group mb-3">
            <label for="price">Price</label>
            <input type="number" 
                   step="0.01" 
                   class="form-control" 
                   name="price" 
                   id="price" 
                   value="{{ $product->price }}" 
                   required>
        </div>

        <div class="form-group mb-3">
            <label for="unit">Unit</label>
            <input type="text" 
                   class="form-control" 
                   name="unit" 
                   id="unit" 
                   value="{{ $product->unit }}" 
                   required>
        </div>

        <div class="form-group mb-3">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" name="image" id="image">
            <!-- @if($product->img_url) -->
                <div class="mt-2">
                    <img src="{{ asset($product->img_url) }}" 
                         alt="Product Image" 
                         width="100">
                </div>
            <!-- @endif -->
        </div>

        <div class="form-group mt-4">
            <a href="{{ route('productPage') }}" class="btn btn-danger">Close</a>
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    </form>
</div>
@endsection
