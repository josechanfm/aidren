<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class TestHuggingFaceAPI extends Command
{
    protected $signature = 'test:huggingface-api';
    protected $description = 'Test the Hugging Face API connection';

    public function handle()
    {
        $client = new Client([
            'verify' => base_path('cacert.pem')
        ]);
        $apiKey = config('services.huggingface.api_key');

        if (empty($apiKey)) {
            $this->error('Hugging Face API key is not set in the configuration.');
            return 1;
        }

        $this->info('Testing Hugging Face API connection...');

        try {
            $response = $client->post('https://api-inference.huggingface.co/models/gpt2', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'inputs' => 'Hello, how are you?',
                ],
            ]);

            $result = json_decode($response->getBody(), true);

            if (isset($result[0]['generated_text'])) {
                $this->info('API connection successful!');
                $this->info('Generated text: ' . $result[0]['generated_text']);
            } else {
                $this->warn('Unexpected API response format.');
                $this->line('Response: ' . json_encode($result));
            }
        } catch (RequestException $e) {
            $this->error('API request failed: ' . $e->getMessage());
            if ($e->hasResponse()) {
                $this->line('Response: ' . $e->getResponse()->getBody()->getContents());
            }
        } catch (\Exception $e) {
            $this->error('An unexpected error occurred: ' . $e->getMessage());
        }
    }
}
