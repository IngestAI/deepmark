<?php

namespace Database\Seeders;

use App\Services\Ai\Enums\AiProviderEnum;
use App\Models\AIProvider;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AiProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $table  = 'a_i_providers';
        $date   = date('Y-m-d H:i:s');

        $openai = AIProvider::where('slug', AiProviderEnum::openai()->value)->first();
        if (!$openai) {
            DB::table($table)->insert([
                'slug' => AiProviderEnum::openai()->value,
                'name' => 'OpenAI',
                'active' => true,
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }

        $anthropic = AIProvider::where('slug', AiProviderEnum::anthropic()->value)->first();
        if (!$anthropic) {
            DB::table($table)->insert([
                'slug' => AiProviderEnum::anthropic()->value,
                'name' => 'Anthropic Claude',
                'active' => true,
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }

        $ai21 = AIProvider::where('slug', AiProviderEnum::ai21()->value)->first();
        if (!$ai21) {
            DB::table($table)->insert([
                'slug' => AiProviderEnum::ai21()->value,
                'name' => 'AI21 Studio',
                'active' => true,
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }

        $amazon = AIProvider::where('slug', AiProviderEnum::amazon()->value)->first();
        if (!$amazon) {
            DB::table($table)->insert([
                'slug' => AiProviderEnum::amazon()->value,
                'name' => 'Amazon',
                'active' => true,
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }

        $cohere = AIProvider::where('slug', AiProviderEnum::cohere()->value)->first();
        if (!$cohere) {
            DB::table($table)->insert([
                'slug' => AiProviderEnum::cohere()->value,
                'name' => 'Co:here',
                'active' => true,
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }

        $ingestai = AIProvider::where('slug', AiProviderEnum::ingestai()->value)->first();
        if (!$ingestai) {
            DB::table($table)->insert([
                'slug' => AiProviderEnum::ingestai()->value,
                'name' => 'IngestAI',
                'active' => true,
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }
    }
}
