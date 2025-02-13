<?php

namespace App\Http\Controllers;

use App\Models\ChatbotResponse;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function getResponse(Request $request)
    {
        $question = strtolower(trim($request->input('message')));

        // Check if the question exists in the database
        $response = ChatbotResponse::where('question', 'LIKE', "%{$question}%")->first();

        return response()->json([
            'message' => $response ? $response->response : "Sorry, I don't understand that. Try asking something else."
        ]);
    }
}
