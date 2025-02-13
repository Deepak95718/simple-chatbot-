<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ChatbotResponse;

class ChatbotResponsesSeeder extends Seeder
{
    public function run()
    {
        ChatbotResponse::insert([
            ['question' => 'hi', 'response' => 'Hello! How can I assist you today?'],
            ['question' => 'how are you', 'response' => 'I am just a bot, but I am functioning well!'],
            ['question' => 'bye', 'response' => 'Goodbye! Have a great day!'],
        ]);
    }
}
