@extends('layouts.master')

@section('title', 'Customer')

@section('content')
<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body">
            {{-- Header with title and create button --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0" style="color:#1d3557;">Customer</h5>
                <a href="{{ route('customerCreate') }}" class="btn btn-sm custom-purple-btn">CREATE</a>
            </div>

            {{-- Entries and Search --}}
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div>
                    <label>Show 
                        <select class="form-select form-select-sm d-inline-block" style="width:auto;">
                            <option>5</option>
                            <option>10</option>
                            <option>25</option>
                            <option>50</option>
                        </select> entries
                    </label>
                </div>
                <div>
                    <label>Search: <input type="search" class="form-control form-control-sm" style="display:inline-block; width:auto;"></label>
                </div>
            </div>

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle mb-0">
                    <thead style="background:#f1f3f5;">
                        <tr>
                            <th style="width:5%;">No</th>
                            <th style="width:25%;">Name</th>
                            <th style="width:30%;">Email</th>
                            <th style="width:20%;">Phone</th>
                            <th style="width:20%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $index => $customer)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>
                                <a href="{{ route('customerId', $customer->id) }}" class="btn btn-outline-success btn-sm" style="border-radius:6px; font-weight:600; font-size:12px; width:65px;">EDIT</a>
                                <form action="{{ route('customer.destroy', $customer->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" style="border-radius:6px; font-weight:600; font-size:12px; width:65px;">DELETE</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @if($customers->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">No entries found.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            {{-- Pagination Info and Controls --}}
            <div class="d-flex justify-content-between align-items-center mt-2">
                <div>
                    Showing 1 to {{ $customers->count() }} of {{ $customers->total() ?? $customers->count() }} entries
                </div>
                <div>
                    {{ $customers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.custom-purple-btn {
  background-color: #800080;
  color: white;
  border: none;
}

.custom-purple-btn:hover {
  background-color: #660066;
  color: white;
}
</style>
@endsection
