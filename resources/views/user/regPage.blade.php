<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card mx-auto" style="max-width: 500px;">
        <div class="card-body">
            <h3 class="card-title text-center mb-4">User Registration</h3>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('saveReg') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">First Name</label>
                    <input type="text" name="first_name" class="form-control" id="first_name" required>
                    @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Last Name</label>
                    <input type="text" name="last_name" class="form-control" id="last_name" required>
                    @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" required>
                    @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="fax" class="form-label">Fax</label>
                    <input type="fax" name="fax" class="form-control" id="fax">
                    @error('fax') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="phone" name="phone" class="form-control" id="phone" required>
                    @error('phone') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                    @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100">Register</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
