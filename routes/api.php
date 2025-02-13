<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::post('/whatsapp/webhook', function (Request $request) {
    $data = $request->all();
    
    if (isset($data['entry'][0]['changes'][0]['value']['messages'])) {
        $messages = $data['entry'][0]['changes'][0]['value']['messages'][0];
        $from = $messages['from'];
        $messageText = $messages['text']['body'];

        // Auto-reply logic
        $reply = match (strtolower($messageText)) {
            'hello' => 'Hi there! How can I help you?',
            'pricing' => 'Our pricing starts at $99.',
            default => 'I did not understand that. Type "hello" to start.'
        };

        // Send response
        Http::withHeaders([
            'Authorization' => 'Bearer ' . env('WHATSAPP_ACCESS_TOKEN'),
            'Content-Type' => 'application/json',
        ])->post("https://graph.facebook.com/v17.0/".env('WHATSAPP_PHONE_NUMBER_ID')."/messages", [
            'messaging_product' => 'whatsapp',
            'to' => $from,
            'text' => ['body' => $reply],
        ]);
    }

    return response()->json(['status' => 'success']);
});
