<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GeminiController extends Controller
{
  
public function chat(Request $request)
{
    $prompt = $request->input('message');

    $response = Http::withHeaders([
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer YOUR_API_KEY'
    ])->post('https://generativelanguage.googleapis.com/v1/models/gemini-1.5-pro:generateContent', [
        'contents' => [
            ['parts' => [['text' => $prompt]]]
        ]
    ]);

    return $response->json();
}
}
