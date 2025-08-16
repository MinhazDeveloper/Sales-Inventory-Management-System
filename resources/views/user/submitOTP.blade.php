<!-- resources/views/submit-otp.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header text-center bg-primary text-white">
                    <h4>Verify OTP</h4>
                </div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('verifyOTPcode') }}" method="POST">
                        @csrf
                        <input type="hidden" name="email" value="{{ session('otp_email') }}">

                        <div class="mb-3">
                            <label for="otp" class="form-label">Enter OTP</label>
                            <input type="text" class="form-control" id="otp" name="otp" placeholder="4-digit code" required>
                            @error('otp')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Submit OTP</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <small>Didn't receive the code? 
                        <a href="{{ route('sendOTP') }}">Resend</a></small>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
