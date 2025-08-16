<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Tailwind CSS CDN (optional for styling) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-sm p-6 bg-white rounded shadow-md">
        <h2 class="text-2xl font-semibold text-center mb-6">Login</h2>

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('userLog') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" required
                    class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
                @error('email')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
                @error('password')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <button type="submit"
                    class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                    Login
                </button>
            </div>

            <div class="text-center text-sm text-gray-600">
                <a href="{{ route('regPage') }}" class="text-blue-500 hover:underline mr-2">Register</a>
                |
                <a href="{{ route('sendOTP') }}" class="text-blue-500 hover:underline ml-2">Forgot Password?</a>
            </div>
        </form>
    </div>
</body>
</html>
