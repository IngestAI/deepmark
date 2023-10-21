<?php

use App\Services\Ai\Enums\AiProviderEnum;
use App\Services\Ai\Enums\AiVectorModelEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $date = date('Y-m-d H:i:s');
        DB::table('a_i_models')->insert([
            'provider_id' => DB::table('a_i_providers')->where('slug', AiProviderEnum::openai()->value)->pluck('id')->first(),
            'slug' => AiVectorModelEnum::textEmbeddingAda002(),
            'name' => 'Text Embedding Ada 002',
            'active' => true,
            'input_format' => 'text',
            'output_format' => 'vector',
            'created_at' => $date,
            'updated_at' => $date,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('a_i_models')->where('slug', AiVectorModelEnum::textEmbeddingAda002())->delete();
    }
};
