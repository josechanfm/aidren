<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ChatbotController extends Controller
{
    public function index()
    {
        return Inertia::render('Chatbot/Index');
    }

    public function chat(Request $request)
    {
        Log::info('Chat request received', $request->all());

        try {
            $request->validate([
                'message' => 'required|string',
                'engine' => 'required|string',
            ]);

            Log::info('Validation passed');

            $client = new Client([
                'verify' => base_path('cacert.pem'),
                'timeout' => 30,
            ]);

            $apiKey = config('services.huggingface.api_key');
            Log::info('API Key (first 4 characters): ' . substr($apiKey, 0, 4) . '...');

            $systemMessage = "You are an expert AI assistant specializing in dispute resolution. Your role is to provide professional, impartial, and constructive advice to help parties resolve conflicts. Always maintain a neutral stance, encourage open communication, and suggest practical solutions based on established dispute resolution techniques. Your responses should be clear, concise, and focused on de-escalating tensions and finding common ground.";

            $conversationHistory = Session::get('conversation_history', []);
            $conversationHistory[] = "Human: " . $request->input('message');
            $fullPrompt = $systemMessage . "\n\n" . implode("\n", $conversationHistory) . "\n\nAI:";

            $engine = $request->input('engine');
            $inputFormat = $this->getInputFormat($engine, $fullPrompt);

            $maxRetries = 3;
            $retryDelay = 5;

            for ($attempt = 1; $attempt <= $maxRetries; $attempt++) {
                try {
                    Log::info("Attempt $attempt: Sending request to Hugging Face API", [
                        'model' => $engine,
                        'inputs' => $inputFormat,
                    ]);

                    $response = $client->post('https://api-inference.huggingface.co/models/' . $engine, [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $apiKey,
                            'Content-Type' => 'application/json',
                        ],
                        'json' => $inputFormat,
                    ]);

                    Log::info('Response received from Hugging Face API', ['status' => $response->getStatusCode(), 'body' => (string) $response->getBody()]);
                    $result = json_decode($response->getBody(), true);

                    $botReply = $this->extractAIResponse($result, $engine);
                    Log::info('Bot reply', ['reply' => $botReply]);

                    $conversationHistory[] = "AI: " . $botReply;
                    Session::put('conversation_history', $conversationHistory);

                    return response()->json([
                        'reply' => $botReply,
                    ])->header('Access-Control-Allow-Origin', '*');
                } catch (RequestException $e) {
                    if ($e->getResponse() && $e->getResponse()->getStatusCode() == 503) {
                        $errorBody = json_decode($e->getResponse()->getBody(), true);
                        if (isset($errorBody['estimated_time'])) {
                            $waitTime = ceil($errorBody['estimated_time']);
                            Log::warning("Model is loading. Waiting for $waitTime seconds before retry.");
                            sleep($waitTime);
                        } else {
                            Log::warning("503 error without estimated time. Waiting for $retryDelay seconds before retry.");
                            sleep($retryDelay);
                        }
                        if ($attempt == $maxRetries) {
                            throw $e;
                        }
                    } else {
                        throw $e;
                    }
                }
            }
        } catch (RequestException $e) {
            Log::error('Chatbot API Error', [
                'message' => $e->getMessage(),
                'request' => $e->getRequest()->getMethod() . ' ' . $e->getRequest()->getUri(),
                'request_headers' => $e->getRequest()->getHeaders(),
                'response' => $e->hasResponse() ? [
                    'status' => $e->getResponse()->getStatusCode(),
                    'body' => $e->getResponse()->getBody()->getContents(),
                ] : null,
            ]);
            return response()->json([
                'reply' => 'I apologize, but I encountered an issue while processing your request. Please try again in a few moments.',
            ], 500)->header('Access-Control-Allow-Origin', '*');
        } catch (\Exception $e) {
            Log::error('Chatbot Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return response()->json([
                'reply' => 'I apologize, but an unexpected error occurred. Please try again later.',
            ], 500)->header('Access-Control-Allow-Origin', '*');
        }
    }

    private function getInputFormat($engine, $prompt)
    {
        switch ($engine) {
            case 'gpt2':
            case 'microsoft/DialoGPT-small':
            case 'microsoft/DialoGPT-medium':
            case 'microsoft/DialoGPT-large':
            case 'EleutherAI/gpt-neo-125M':
            case 'EleutherAI/gpt-j-6B':
                return [
                    'inputs' => $prompt,
                    'parameters' => [
                        'max_length' => 250,
                        'temperature' => 0.7,
                        'top_p' => 0.9,
                        'repetition_penalty' => 1.2,
                    ],
                ];
            case 'facebook/bart-large':
            case 't5-small':
                return [
                    'inputs' => $prompt,
                ];
            default:
                return ['inputs' => $prompt];
        }
    }

    private function extractAIResponse($result, $engine)
    {
        switch ($engine) {
            case 'gpt2':
            case 'microsoft/DialoGPT-small':
            case 'microsoft/DialoGPT-medium':
            case 'microsoft/DialoGPT-large':
            case 'EleutherAI/gpt-neo-125M':
            case 'EleutherAI/gpt-j-6B':
                return isset($result[0]['generated_text']) ? $this->extractLastMessage($result[0]['generated_text']) : 'I apologize, but I couldn\'t generate a response.';
            case 'facebook/bart-large':
            case 't5-small':
                return isset($result[0]['summary_text']) ? $result[0]['summary_text'] : 'I apologize, but I couldn\'t generate a response.';
            default:
                return isset($result[0]['generated_text']) ? $result[0]['generated_text'] : 'I apologize, but I couldn\'t generate a response.';
        }
    }

    private function extractLastMessage($text)
    {
        $messages = explode("\n", trim($text));
        return end($messages);
    }
}