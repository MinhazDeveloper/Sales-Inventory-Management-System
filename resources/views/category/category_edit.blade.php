@extends('layouts.master')

@section('title', 'Edit Category')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body">
            <h5 class="fw-bold mb-3" style="color:#1d3557;">Edit Category</h5>

            <form action="{{ route('categoryUpdate', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="category_name" class="form-label">Category Name</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="category_name" 
                        name="name" 
                        value="{{ old('name', $category->name) }}" 
                        required
                    >
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
