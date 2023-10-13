<?php

namespace App\Services\Ai\Models;

use App\Services\Ai\Data\AnthropicAiModelResponse;
use Spatie\LaravelData\Data;

class AnthropicAiModel implements AiModel
{
    private string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.anthropic.api_key');
    }
    public function send(Data $request): Data
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.anthropic.com/v1/complete',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $request->toJson(),
            CURLOPT_HTTPHEADER => [
                'accept: application/json',
                'anthropic-version: 2023-06-01',
                'x-api-key: ' . $this->apiKey,
                'content-type: application/json'
            ],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            throw new \Exception('cURL Error #:' . $err);
        }

        $data = @json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Wrong JSON:' . $response);
        }

        return new AnthropicAiModelResponse($data);
    }
}