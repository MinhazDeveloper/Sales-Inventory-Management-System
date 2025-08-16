@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Create Product</h2>

    <form action="{{ route('productStore') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-3">
            <label for="category">Category</label>
            <select class="form-control" name="category_id" id="category" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="product_name">Product Name</label>
            <input type="text" class="form-control" name="product_name" id="product_name" required>
        </div>

        <div class="form-group mb-3">
            <label for="price">Price</label>
            <input type="number" step="0.01" class="form-control" name="price" id="price" required>
        </div>

        <div class="form-group mb-3">
            <label for="unit">Unit</label>
            <input type="text" class="form-control" name="unit" id="unit" required>
        </div>

        <div class="form-group mb-3">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" name="image" id="image">
        </div>

        <div class="form-group mt-4">
            <a href="{{route('productPage')}}" class="btn btn-danger">Close</a>
            <button type="submit" class="btn btn-success">Save</button>
        </div>

    </form>
</div>
@endsection
