@extends('layouts.master')

@section('content')
<style>
    body {
        background-color: #f9f9f9;
    }
    .invoice-card {
        border-radius: 10px;
        background: #fff;
        box-shadow: 0px 2px 6px rgba(0,0,0,0.1);
        padding: 15px;
    }
    .section-title {
        font-weight: bold;
        font-size: 14px;
        color: #555;
        margin-bottom: 8px;
    }
    .invoice-header img {
        height: 30px;
        margin-right: 5px;
    }
    .invoice-header h5 {
        font-weight: bold;
        margin: 0;
    }
    .table thead th {
        font-size: 13px;
        font-weight: bold;
        background-color: #f5f5f5;
        border: none;
    }
    .table td {
        font-size: 13px;
        vertical-align: middle;
    }
    .confirm-btn {
        background: linear-gradient(90deg, #007bff, #00aaff);
        border: none;
        font-weight: bold;
        color: white;
        padding: 8px;
        border-radius: 6px;
        width: 100%;
    }
    .input-discount {
        border-radius: 6px;
        padding: 6px;
        border: 1px solid #ccc;
        width: 100%;
    }
    .pick-card {
        height: 100%;
        border-radius: 10px;
        background: #fff;
        box-shadow: 0px 2px 6px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }
    .pick-card h6 {
        font-weight: bold;
        margin-bottom: 5px;
    }
    .pick-card p {
        color: #999;
        margin: 0;
    }
</style>

<div class="container-fluid mt-3">
    <div class="row g-3">

        {{-- Invoice Section --}}
        <div class="col-md-4">
            <div class="invoice-card">

                {{-- Billed To --}}
                <p class="section-title mb-1">BILLED TO</p>
                <p class="mb-0" style="font-size:13px;">Name: </p>
                <p class="mb-0" style="font-size:13px;">Email: </p>
                <p class="mb-3" style="font-size:13px;">User ID: </p>

                {{-- Logo + Invoice --}}
                <div class="d-flex align-items-center justify-content-between mb-2">
                    {{--<div class="d-flex align-items-center">
                        <span style="color: orange; font-size:20px;">●</span>
                        <h5 class="ms-1" style="margin:0;">E-Shop</h5>
                    </div>--}}
                    <div>
                        <p class="mb-0" style="font-size:12px; font-weight:bold;">Invoice</p>
                        <p class="mb-0" style="font-size:12px;">Date: {{ date('Y-m-d') }}</p>
                    </div>
                </div>

                {{-- Product Table --}}
                <table class="table table-sm mb-2">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Dynamic Product Rows --}}
                    </tbody>
                </table>

                {{-- Totals --}}
                <div style="font-size:13px; font-weight:bold;">
                    <p class="mb-1">TOTAL: $</p>
                    <p class="mb-1">PAYABLE: $</p>
                    <p class="mb-1">VAT(5%): $</p>
                    <p class="mb-1">Discount: $</p>
                </div>

                {{-- Discount Input --}}
                <label class="mt-2 mb-1" style="font-size:13px;">Discount(%)</label>
                <input type="number" class="input-discount" value="0">

                {{-- Confirm Button --}}
                <button class="confirm-btn mt-3">CONFIRM</button>
            </div>
        </div>

        {{-- Product Pick --}}
        <div class="col-md-4">
            <div class="pick-card w-100 px-3 py-3">
                <table class="table table-borderless mb-0">
                    <thead>
                        <tr>
                            <th style="font-size:14px; font-weight: bold;">Product</th>
                            <th style="font-size:14px; font-weight: bold;">Pick</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- No data for now, matching screenshot --}}
                    </tbody>
                </table>
            </div>
        </div>


        {{-- Customer Pick --}}
        <div class="col-md-4">
            <div class="pick-card">
                <h6>Customer</h6>
                <p>Pick</p>
            </div>
        </div>

    </div>
</div>
@endsection
