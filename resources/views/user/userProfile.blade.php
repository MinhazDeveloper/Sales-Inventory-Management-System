@extends('layouts.master')

@section('title', 'E-Shop | Dashboard')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-4 border-bottom pb-2">User Profile Details</h4>

            <form action="{{ route('profileUpdate') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    {{-- Email Address --}}
                    <div class="col-md-4">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" name="email" id="email" 
                               class="form-control bg-light" 
                               placeholder="User Email" 
                               autocomplete="email">
                    </div>

                    {{-- First Name --}}
                    <div class="col-md-4">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" name="first_name" id="first_name" 
                               class="form-control" 
                               placeholder="First Name">
                    </div>

                    {{-- Last Name --}}
                    <div class="col-md-4">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" name="last_name" id="last_name" 
                               class="form-control" 
                               placeholder="Last Name">
                    </div>
                </div>

                <div class="row mb-4">
                    {{-- Mobile Number --}}
                    <div class="col-md-4">
                        <label for="phone" class="form-label">Mobile Number</label>
                        <input type="text" name="phone" id="phone" 
                               class="form-control" 
                               placeholder="phone">
                    </div>
                    {{-- Fax --}}
                    <div class="col-md-4">
                        <label for="fax" class="form-label">Fax</label>
                        <input type="text" name="fax" id="fax" 
                               class="form-control" 
                               placeholder="fax">
                    </div>

                    {{-- Password --}}
                    <div class="col-md-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" 
                               class="form-control" 
                               placeholder="User Password">
                    </div>
                </div>
                <div id="loader" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); z-index:1000;">
                    <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                    </div>
                </div>

                {{-- Update Button --}}
                    <button type="submit" class="btn btn-primary px-4" style="background-color: #800080; border-color: #800080;">UPDATE</button>
            </form>
        </div>
    </div>
</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    function showLoader() {
        const loader = document.getElementById('loader');
        if (loader) loader.style.display = 'block';
    }
    function hideLoader() {
        const loader = document.getElementById('loader');
        if (loader) loader.style.display = 'none';
    }
    function errorToast(message) {
        alert(message);
    }

    async function getProfile(){
        showLoader();
        try {
            let res = await axios.get('/user-profile');

            if(res.status === 200 && res.data && res.data.status === 'success'){
                let data = res.data.data;
                document.getElementById('email').value = data.email;
                document.getElementById('first_name').value = data.first_name;
                document.getElementById('last_name').value = data.last_name;
                document.getElementById('phone').value = data.phone;
                document.getElementById('fax').value = data.fax;
                document.getElementById('password').value = data.password;
            } else {
                errorToast('Something went wrong');
            }
        } catch (error) {
            errorToast('Request failed');
            console.error(error);
        } finally {
            hideLoader();
        }
    }
    document.addEventListener('DOMContentLoaded', getProfile);
</script>

