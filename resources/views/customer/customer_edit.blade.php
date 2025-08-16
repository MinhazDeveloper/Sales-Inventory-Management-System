@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <h3>Edit Customer</h3>
    <form id="customerForm" onsubmit="UpdateCustomer(event)">
        @csrf
        @method('PUT') {{-- update request er jonno --}}

        <div class="form-group mb-3">
            <label for="customerName">Customer Name *</label>
            <input type="text" name="name" class="form-control" id="customerName" 
                   value="{{ $customer->name }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="email">Customer Email *</label>
            <input type="email" name="email" class="form-control" id="email" 
                   value="{{ $customer->email }}" required>
        </div>

        <div class="form-group mb-4">
            <label for="phone">Customer Phone *</label>
            <input type="text" name="phone" class="form-control" id="phone" 
                   value="{{ $customer->phone }}" required>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('customerPage') }}" class="btn btn-secondary">CANCEL</a>
            <button id="save-btn" type="submit" class="btn btn-success" style="background-color: #800080;">UPDATE</button>
        </div>
    </form>
</div>

{{-- Axios --}}
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
{{-- Toastify --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<script>
    async function UpdateCustomer(event) {
        event.preventDefault(); // default form submit bondho korar jonno

        const saveBtn = document.getElementById('save-btn');
        saveBtn.disabled = true;
        saveBtn.innerText = 'Updating...';

        const customerName = document.getElementById('customerName').value;
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone').value;

        try {
            // PUT request pathacchi
            const response = await axios.put('{{ route("customerUpdate", $customer->id) }}', {
                name: customerName,
                email: email,
                phone: phone,
                // _token: '{{ csrf_token() }}'
            });

            // success toast
            Toastify({
                text: "✅ Customer updated successfully",
                duration: 3000,
                gravity: "top",
                position: "center",
                backgroundColor: "#4CAF50",
                stopOnFocus: true
            }).showToast();

            // 1 sec pore list page e jabe
            setTimeout(() => {
                window.location.href = '{{ route("customerPage") }}';
            }, 1000);

        } catch (error) {
            console.error(error);

            // error toast
            Toastify({
                text: "❌ Customer update failed",
                duration: 3000,
                gravity: "top",
                position: "right",
                backgroundColor: "#E91E63",
                stopOnFocus: true
            }).showToast();
        } finally {
            saveBtn.disabled = false;
            saveBtn.innerText = 'UPDATE';
        }
    }
</script>
@endsection
