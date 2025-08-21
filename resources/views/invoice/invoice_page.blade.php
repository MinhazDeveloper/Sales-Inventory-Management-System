@extends('layouts.master')

@section('content')
<div class="container">
    <h2>New Sale</h2>
    <form action="{{ route('invoiceSave') }}" method="POST" id="saleForm">
        @csrf
        <input type="hidden" name="sale_date" id="sale_date">
        <div class="mb-3">
            <label>Customer Name</label>
            <select name="customer_id" id="customer_id" class="form-control" required>
                <option value="">Select Customer</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>

        <table class="table" id="productsTable">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                    <th><button type="button" id="addRow" class="btn btn-sm btn-primary">Add</button></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <h4>Total: <span id="total">0</span></h4>
        <input type="hidden" name="total_amount" id="total_amount">
        <button class="btn btn-success" type="submit">Save Sale</button>
    </form>
</div>

<script>
    // Ajker tarikh set kora
    document.addEventListener('DOMContentLoaded', function() {
        let today = new Date();
        let formattedDate = today.getFullYear() + '-' +
            String(today.getMonth() + 1).padStart(2, '0') + '-' +
            String(today.getDate()).padStart(2, '0');
        
        document.getElementById('sale_date').value = formattedDate;
    });
    let products = @json($products);
    function calculateTotal() {
        let total = 0;
        document.querySelectorAll('.subtotal').forEach(el => total += parseFloat(el.value || 0));
        document.getElementById('total').innerText = total.toFixed(2);
        document.getElementById('total_amount').value = total;
    }

    document.getElementById('addRow').addEventListener('click', () => {
        let tbody = document.querySelector('#productsTable tbody');
        let tr = document.createElement('tr');
        tr.innerHTML = `
            <td>
                <select name="products[]" class="form-control product-select" required>
                    <option value="">Select</option>
                    ${products.map(p => `<option value="${p.id}" data-price="${p.price}">${p.product_name}</option>`).join('')}
                </select>
            </td>
            <td><input type="text" name="prices[]" class="form-control price" readonly></td>
            <td><input type="number" name="quantities[]" class="form-control qty" value="1" min="1"></td>
            <td><input type="text" name="subtotals[]" class="form-control subtotal" readonly></td>
            <td><button type="button" class="btn btn-sm btn-danger removeRow">X</button></td>
        `;
        tbody.appendChild(tr);

        tr.querySelector('.product-select').addEventListener('change', function(){
            let price = this.selectedOptions[0].dataset.price;
            let qty = tr.querySelector('.qty').value;
            tr.querySelector('.price').value = price;
            tr.querySelector('.subtotal').value = (price * qty).toFixed(2);
            calculateTotal();
        });

        tr.querySelector('.qty').addEventListener('input', function(){
            let price = tr.querySelector('.price').value;
            tr.querySelector('.subtotal').value = (price * this.value).toFixed(2);
            calculateTotal();
        });

        tr.querySelector('.removeRow').addEventListener('click', function(){
            tr.remove();
            calculateTotal();
        });
    });
</script>
@endsection
