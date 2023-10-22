<?php

namespace App\Services\Ai\Conditions;

use App\Services\Ai\AiFactory;
use App\Services\Ai\Data\TextEmbeddingAda003AiModelRequest;
use App\Services\Ai\Enums\AiProviderEnum;
use App\Services\Ai\Enums\AiVectorModelEnum;
use Illuminate\Support\Facades\Log;

class VectorSimilarityConditionStrategy implements ConditionStrategyInterface
{
    private const MIN = 0.9;
    public float $similarity = 0;

    public function apply(string $modelAnswer, string $term): bool
    {
        $embeddingTermResponse = AiFactory::provider(AiProviderEnum::openai())
            ->model(AiVectorModelEnum::textEmbeddingAda002())
            ->send(new TextEmbeddingAda003AiModelRequest($term));
        if (!$embeddingTermResponse->isSuccessful()) {
            Log::channel('tasks')->debug('Embedding prompt response error: ' . json_encode($embeddingTermResponse));
            return false;
        }
        $embeddingAnswerResponse = AiFactory::provider(AiProviderEnum::openai())
            ->model(AiVectorModelEnum::textEmbeddingAda002())
            ->send(new TextEmbeddingAda003AiModelRequest($modelAnswer));
        if (!$embeddingAnswerResponse->isSuccessful()) {
            Log::channel('tasks')->debug('Embedding answer response error: ' . json_encode($embeddingAnswerResponse));
        }
        $this->similarity = $this->cosin(
            $embeddingAnswerResponse->getVectors(),
            $embeddingTermResponse->getVectors()
        );

        Log::channel('tasks')->debug('Similarity: ' . json_encode($this->similarity));

        if (empty($this->similarity) || $this->similarity < self::MIN) return false;

        return true;
    }

    private function cosin($a, $b) {
        $result = array_map(function($x, $y) {
            return $x * $y;
        }, $a, $b);
        return array_sum($result);
    }
}
