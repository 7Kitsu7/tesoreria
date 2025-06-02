<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeminiService
{
    protected $apiKey;
    protected $url;

    public function __construct()
    {
        $this->apiKey = env('GEMINI_API_KEY');
        $this->url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=' . $this->apiKey;

    }

    public function enviarMensaje($mensaje)
    {
        $response = Http::post($this->url, [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $mensaje]
                    ]
                ]
            ]
        ]);

        if ($response->successful()) {
            return $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? 'Sin respuesta';
        }

        return 'Error al comunicarse con Gemini: ' . $response->body();
    }
}
