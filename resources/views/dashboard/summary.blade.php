@extends('layouts.master')

@section('title', 'E-Shop | Dashboard')

@section('content')
<main class="content">
    <div class="stat-grid">
        <div class="stat-card">
            <div>
                <p class="title">Product</p>
                <p class="value" id="product">{{ $totalProducts ?? 0 }}</p>
            </div>
            <div class="thumb"><i class="fas fa-store"></i></div>
        </div>

        <div class="stat-card">
            <div>
                <p class="title">Category</p>
                <p class="value" id="category">{{ $totalCategories ?? 0 }}</p>
            </div>
            <div class="thumb"><i class="fas fa-store"></i></div>
        </div>

        <div class="stat-card">
            <div>
                <p class="title">Customer</p>
                <p class="value" id="customer">{{ $totalCustomers ?? 0 }}</p>
            </div>
            <div class="thumb"><i class="fas fa-store"></i></div>
        </div>

        <div class="stat-card">
            <div>
                <p class="title">Invoice</p>
                <p class="value" id="invoice">{{ $totalInvoices ?? 0 }}</p>
            </div>
            <div class="thumb"><i class="fas fa-store"></i></div>
        </div>

        <div class="stat-card">
            <div>
                <p class="title">$ Total Sale</p>
                <p class="value" id="total_sale">{{ number_format($totalSale ?? 0, 2) }}</p>
            </div>
            <div class="thumb"><i class="fas fa-dollar-sign"></i></div>
        </div>

        <div class="stat-card">
            <div>
                <p class="title">$ Vat Collection</p>
                <p class="value">{{ number_format($vatCollection ?? 0, 2) }}</p>
            </div>
            <div class="thumb"><i class="fas fa-dollar-sign"></i></div>
        </div>

        <div class="stat-card">
            <div>
                <p class="title">$ Total Collection</p>
                <p class="value">{{ number_format($totalCollection ?? 0, 2) }}</p>
            </div>
            <div class="thumb"><i class="fas fa-dollar-sign"></i></div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    async function getdata(){
        let result = await axios.get("summary");

        document.getElementById('product').innerHTML = result.data.product;
        document.getElementById('category').innerHTML = result.data.category;
        document.getElementById('customer').innerHTML = result.data.customer;
        document.getElementById('invoice').innerHTML = result.data.invoice;
        document.getElementById('total_sale').innerHTML = result.data.total_sale;
    }
    getdata();
</script>
@endsection
