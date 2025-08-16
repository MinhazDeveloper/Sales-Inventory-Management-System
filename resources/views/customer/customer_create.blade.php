@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <h3>Create Customer</h3>
    <form id="customerForm" onsubmit="Save(event)">
        @csrf
        <div class="form-group mb-3">
            <label for="customerName">Customer Name *</label>
            <input type="text" name="name" class="form-control" id="customerName" required>
        </div>

        <div class="form-group mb-3">
            <label for="email">Customer Email *</label>
            <input type="email" name="email" class="form-control" id="email" required>
        </div>

        <div class="form-group mb-4">
            <label for="phone">Customer Phone *</label>
            <input type="text" name="phone" class="form-control" id="phone" required>
        </div>

        <div class="d-flex justify-content-between">
            <button type="reset" class="btn btn-pink" style="background-color: #e91e63; color: white;">RESET</button>
            <button id="save-btn" type="submit" class="btn btn-success" style="background-color: #800080;">SAVE</button>
        </div>
    </form>
</div>
{{-- for axios --}}
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
{{-- Toastify CSS & JS --}}
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<script>
    async function Save(event) {
        event.preventDefault(); // form submit bondho korar jonno

        //user dhara double submit button aranor jonno
        const saveBtn = document.getElementById('save-btn');
        saveBtn.disabled = true;
        saveBtn.innerText = 'Saving...';

        const customerName = document.getElementById('customerName').value;
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone').value;

        try {
            const response = await axios.post('{{ route("customerSave") }}', {
                name: customerName,
                email: email,
                phone: phone,
                // _token: '{{ csrf_token() }}'
            });

            // to show toast
            Toastify({
                text: "✅ Customer created successfully",
                duration: 3000,
                gravity: "top",
                position: "center",
                backgroundColor: "#4CAF50",
                stopOnFocus: true
            }).showToast();

            // 1 sec por ei route e jabe
            setTimeout(() => {
                window.location.href = '{{ route("customerPage") }}';
            }, 1000);
            // document.getElementById('customerForm').reset();

        } catch (error) {
            console.error(error);

            // error toast dekhanor jonno
            Toastify({
                text: "❌ Customer created failed",
                duration: 3000,
                gravity: "top",
                position: "right",
                backgroundColor: "#E91E63",
                stopOnFocus: true
            }).showToast();

        } finally {
            saveBtn.disabled = false;
            saveBtn.innerText = 'SAVE';
        }
    }
</script>
@endsection
