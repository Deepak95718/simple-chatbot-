<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Login</h2>
        
        <form method="POST" action="{{ route('checkauth') }}" class="space-y-4">
            @csrf
            
            <div>
                <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                <input type="email" name="email" id="email" required 
                    class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 outline-none"
                    placeholder="Enter your email">
            </div>

            <div>
                <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
                <input type="password" name="password" id="password" required 
                    class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 outline-none"
                    placeholder="Enter your password">
            </div><br>
            <a href="{{ route('forgot_password') }}" class="text-blue-600 hover:underline">Forgot Password?</a>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                Login
            </button>
           
        </form>
    
     
        <div class="text-center mt-4">
            <a href="/auth/google" 
               class="w-full inline-block text-center bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition">
                Continue with Google
            </a>
        </div>

        <p class="text-center text-gray-600 mt-4">
            Don't have an account? 
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register</a>
        </p>
    </div>

</body>
</html>
