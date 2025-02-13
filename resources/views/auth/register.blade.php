<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-6">Register</h2>
        
        <form method="POST" action="{{ route('registerauth') }}" class="space-y-4">
            @csrf
            
            <div>
                <label for="name" class="block text-gray-700 font-medium">Name</label>
                <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 outline-none" placeholder="Enter your name">
            </div>

            <div>
                <label for="email" class="block text-gray-700 font-medium">Email</label>
                <input type="email" name="email" id="email" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 outline-none" placeholder="Enter your email">
            </div>

            <div>
                <label for="password" class="block text-gray-700 font-medium">Password</label>
                <input type="password" name="password" id="password" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 outline-none" placeholder="Enter your password">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">Register</button>
        </form>
        
        <p class="text-center text-gray-600 mt-4">
            Already have an account? 
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
        </p>
    </div>

</body>
</html>
