<?php

namespace App\Services\Ai\Models;

use App\Services\Ai\Data\CohereSummarizeAiModelResponse;
use Spatie\LaravelData\Data;

class CohereSummarizeAiModel implements AiModel
{
    protected string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.cohere.api_key');
    }
    public function send(Data $request): Data
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.cohere.ai/v1/' . $request->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $request->toJson(),
            CURLOPT_HTTPHEADER => [
                'accept: application/json',
                'authorization: Bearer ' . $this->apiKey,
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

        return new CohereSummarizeAiModelResponse($data);
    }
}
