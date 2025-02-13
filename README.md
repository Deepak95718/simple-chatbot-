# Laravel Project with Authentication & Chatbot

## 🚀 Project Overview
This Laravel project includes:
- **User Authentication** (Login, Register, Forgot Password, Email Verification)
- **Social Login** (Google)
- **Dashboard with AI Chatbot** (Fetching responses from the database)

## 🛠️ Installation Guide

### 1️⃣ Clone the Repository
```bash
git clone https://github.com/your-username/your-repo.git
cd your-repo
```

### 2️⃣ Install Dependencies
```bash
composer install
```

### 3️⃣ Configure Environment
```bash
cp .env.example .env
php artisan key:generate
```
Update your `.env` file with database credentials and API keys.

### 4️⃣ Run Migrations & Seeders
```bash
php artisan migrate --seed
```

### 5️⃣ Start the Server
```bash
php artisan serve
```

---
## 🔐 Authentication Features
- **User Registration & Login** (custom authentication)
- **Forgot & Reset Password** (via Email)
- **Social Login** (Google)

### Enable Social Login
1. Install Laravel Socialite:
   ```bash
   composer require laravel/socialite
   ```
2. Configure `.env` with API credentials:
   ```env
   GOOGLE_CLIENT_ID=your-client-id
   GOOGLE_CLIENT_SECRET=your-client-secret
   GOOGLE_REDIRECT_URL=http://127.0.0.1:8000/auth/google/callback
   ```
3. Update `config/services.php`:
   ```php
   'google' => [
       'client_id' => env('GOOGLE_CLIENT_ID'),
       'client_secret' => env('GOOGLE_CLIENT_SECRET'),
       'redirect' => env('GOOGLE_REDIRECT_URL'),
   ],
   ```

---
## 🤖 Chatbot (Fetching from Database)
### **1️⃣ Create Chatbot Responses Table**
```bash
php artisan make:migration create_chatbot_responses_table
```
Modify migration file:
```php
Schema::create('chatbot_responses', function (Blueprint $table) {
    $table->id();
    $table->string('question');
    $table->text('response');
    $table->timestamps();
});
```
Run migrations:
```bash
php artisan migrate
```

### **2️⃣ Insert Sample Data**
```bash
php artisan tinker
use App\Models\ChatbotResponse;
ChatbotResponse::create(['question' => 'hi', 'response' => 'Hello! How can I help you?']);
exit;
```

### **3️⃣ Chatbot Controller**
Create a controller:
```bash
php artisan make:controller ChatbotController
```
Modify `ChatbotController.php`:
```php
public function getResponse(Request $request)
{
    $question = strtolower(trim($request->message));
    $response = ChatbotResponse::where('question', 'LIKE', "%{$question}%")->first();
    return response()->json(['message' => $response ? $response->response : "I don't understand that."]);
}
```

### **4️⃣ Define Route**
```php
Route::post('/chatbot', [ChatbotController::class, 'getResponse'])->name('chatbot.response');
```

### **5️⃣ Add Chatbot to Dashboard**
```html
<input type="text" id="userMessage" placeholder="Type your message...">
<button onclick="sendMessage()">Send</button>
<div id="chatbox"></div>
<script>
function sendMessage() {
    var message = document.getElementById("userMessage").value;
    fetch("{{ route('chatbot.response') }}", {
        method: "POST",
        headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
        body: JSON.stringify({message: message})
    })
    .then(response => response.json())
    .then(data => document.getElementById("chatbox").innerHTML += `<p>Bot: ${data.message}</p>`);
}
</script>
```

---
## 📜 License
This project is licensed under the MIT License.

---
## 📧 Contact
For any queries, contact: `dy1883078@gmail.com`

