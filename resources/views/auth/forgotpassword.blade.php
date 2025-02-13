<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Forgot Password ?</h2>
        <p style="text-align: center; font-family: 'Courier New', Courier, monospace; color: blue; font-weight: bold;" >Please enter your email so that we can send you a reset link ...</p>
        <form method="POST" action="{{ route('sendresetlink') }}" class="space-y-4">
            @csrf
            
            <div>
                <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                <input type="email" name="email" id="email" required 
                    class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 outline-none"
                    placeholder="Enter your email">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                Send
            </button>
           
        </form>
    </div>

</body>
</html>
