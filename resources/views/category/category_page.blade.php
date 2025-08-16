@extends('layouts.master')

@section('title', 'Category')

@section('content')
<div class="container mt-4">
    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body">
            {{-- Header with title and button --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0" style="color:#1d3557;">Category</h5>
                <a href="{{route('categoryCreate')}}" class="btn btn-create" style="background-color: #800080; color: white;">CREATE</a>

            </div>

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table table-bordered align-middle mb-0">
                    <thead style="background-color: #f8f9fa;">
                        <tr>
                            <th style="width:60px;background-color: #f2f4f2;">No</th>
                            <th style="background-color: #f2f4f2;">Category</th>
                            <th style="width:150px;background-color: #f2f4f2;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $key => $category)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <a href="{{ route('categories.id', $category->id) }}" 
                                       class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('category.destroy', $category->id) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" 
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">No categories found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Custom CSS --}}
@push('styles')

@endpush
@endsection
