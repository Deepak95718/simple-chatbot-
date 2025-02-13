<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Reset Password</h2>
        <form method="POST" action="{{ route('updatepassword') }}" class="space-y-4">
            @csrf
            
            <div>
                <input type="hidden" name="token" value="{{$token}}">
                <input type="hidden" name="email" value="{{$email}}">
                  
                <label for="password" class="block text-gray-700 font-medium mb-1">Old Password</label>
                <input type="Password" name="password" id="password" required 
                    class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 outline-none"
                    placeholder="Enter your old password">
                    
                    <label for="password" class="block text-gray-700 font-medium mb-1">New Password</label>
                <input type="Password" name="newpassword" id="newpassword" required 
                    class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 outline-none"
                    placeholder="Enter your old password">
                    
                    <label for="password" class="block text-gray-700 font-medium mb-1">Confirm Password</label>
                <input type="Password" name="confirmpassword" id="confirmpassword" required 
                    class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 outline-none"
                    placeholder="Please re-enter your password">    
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                Send
            </button>
           
        </form>
    </div>

</body>
</html>
