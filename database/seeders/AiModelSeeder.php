<?php

namespace Database\Seeders;

use App\Models\AIModel;
use App\Models\AIProvider;
use App\Services\Ai\Enums\AiProviderEnum;
use App\Services\Ai\Enums\AiTextModelEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AiModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $table  = 'a_i_models';
        $date   = date('Y-m-d H:i:s');

        $gpt35 = AIModel::where('slug', AiTextModelEnum::gpt3_5())->first();
        if (!$gpt35) {
            DB::table($table)->insert([
                'provider_id' => AIProvider::where('slug', AiProviderEnum::openai()->value)->pluck('id')->first(),
                'slug' => AiTextModelEnum::gpt3_5(),
                'name' => 'ChatGPT (GPT 3.5 Turbo)',
                'active' => true,
                'input_format' => 'text',
                'output_format' => 'text',
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }

        $gpt4 = AIModel::where('slug', AiTextModelEnum::gpt4())->first();
        if (!$gpt4) {
            DB::table($table)->insert([
                'provider_id' => AIProvider::where('slug', AiProviderEnum::openai()->value)->pluck('id')->first(),
                'slug' => AiTextModelEnum::gpt4(),
                'name' => 'GPT 4',
                'active' => true,
                'input_format' => 'text',
                'output_format' => 'text',
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }

        $textDavinci3= AIModel::where('slug', AiTextModelEnum::textDavinci003())->first();
        if (!$textDavinci3) {
            DB::table($table)->insert([
                'provider_id' => AIProvider::where('slug', AiProviderEnum::openai()->value)->pluck('id')->first(),
                'slug' => AiTextModelEnum::textDavinci003(),
                'name' => 'Text Davinci 003',
                'active' => true,
                'input_format' => 'text',
                'output_format' => 'text',
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }

        $textDavinci2= AIModel::where('slug', AiTextModelEnum::textDavinci002())->first();
        if (!$textDavinci2) {
            DB::table($table)->insert([
                'provider_id' => AIProvider::where('slug', AiProviderEnum::openai()->value)->pluck('id')->first(),
                'slug' => AiTextModelEnum::textDavinci002(),
                'name' => 'Text Davinci 002',
                'active' => true,
                'input_format' => 'text',
                'output_format' => 'text',
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }

        $textCurie1 = AIModel::where('slug', AiTextModelEnum::textCurie001())->first();
        if (!$textCurie1) {
            DB::table($table)->insert([
                'provider_id' => AIProvider::where('slug', AiProviderEnum::openai()->value)->pluck('id')->first(),
                'slug' => AiTextModelEnum::textCurie001(),
                'name' => 'Text Curie 001',
                'active' => true,
                'input_format' => 'text',
                'output_format' => 'text',
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }

        $textBabbage001 = AIModel::where('slug', AiTextModelEnum::textBabbage001())->first();
        if (!$textBabbage001) {
            DB::table($table)->insert([
                'provider_id' => AIProvider::where('slug', AiProviderEnum::openai()->value)->pluck('id')->first(),
                'slug' => AiTextModelEnum::textBabbage001(),
                'name' => 'Text Babbage 001',
                'active' => true,
                'input_format' => 'text',
                'output_format' => 'text',
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }

        $textAda001 = AIModel::where('slug', AiTextModelEnum::textAda001())->first();
        if (!$textAda001) {
            DB::table($table)->insert([
                'provider_id' => AIProvider::where('slug', AiProviderEnum::openai()->value)->pluck('id')->first(),
                'slug' => AiTextModelEnum::textAda001(),
                'name' => 'Text Ada 001',
                'active' => true,
                'input_format' => 'text',
                'output_format' => 'text',
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }

        $generate = AIModel::where('slug', AiTextModelEnum::generate())->first();
        if (!$generate) {
            DB::table($table)->insert([
                'provider_id' => AIProvider::where('slug', AiProviderEnum::cohere()->value)->pluck('id')->first(),
                'slug' => AiTextModelEnum::generate(),
                'name' => 'Generate',
                'active' => true,
                'input_format' => 'text',
                'output_format' => 'text',
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }

        $summarize = AIModel::where('slug', AiTextModelEnum::summarize())->first();
        if (!$summarize) {
            DB::table($table)->insert([
                'provider_id' => AIProvider::where('slug', AiProviderEnum::cohere()->value)->pluck('id')->first(),
                'slug' => AiTextModelEnum::summarize(),
                'name' => 'Summarize',
                'active' => true,
                'input_format' => 'text',
                'output_format' => 'text',
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }

        $claude1 = AIModel::where('slug', AiTextModelEnum::claude1())->first();
        if (!$claude1) {
            DB::table($table)->insert([
                'provider_id' => AIProvider::where('slug', AiProviderEnum::anthropic()->value)->pluck('id')->first(),
                'slug' => AiTextModelEnum::claude1(),
                'name' => 'Claude-1',
                'active' => true,
                'input_format' => 'text',
                'output_format' => 'text',
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }

        $claude1_100k = AIModel::where('slug', AiTextModelEnum::claudeInstant1_100k())->first();
        if (!$claude1_100k) {
            DB::table($table)->insert([
                'provider_id' => AIProvider::where('slug', AiProviderEnum::anthropic()->value)->pluck('id')->first(),
                'slug' => AiTextModelEnum::claude1_100k(),
                'name' => 'Claude-1-100k',
                'active' => true,
                'input_format' => 'text',
                'output_format' => 'text',
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }

        $claudeInstant1 = AIModel::where('slug', AiTextModelEnum::claudeInstant1())->first();
        if (!$claudeInstant1) {
            DB::table($table)->insert([
                'provider_id' => AIProvider::where('slug', AiProviderEnum::anthropic()->value)->pluck('id')->first(),
                'slug' => AiTextModelEnum::claudeInstant1(),
                'name' => 'Claude-instant-11',
                'active' => true,
                'input_format' => 'text',
                'output_format' => 'text',
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }

        $claudeInstant1_100k = AIModel::where('slug', AiTextModelEnum::claude1_100k())->first();
        if (!$claudeInstant1_100k) {
            DB::table($table)->insert([
                'provider_id' => AIProvider::where('slug', AiProviderEnum::anthropic()->value)->pluck('id')->first(),
                'slug' => AiTextModelEnum::claude1_100k(),
                'name' => 'Claude-instant-1-100k',
                'active' => true,
                'input_format' => 'text',
                'output_format' => 'text',
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }

        $jurassic2Light = AIModel::where('slug', AiTextModelEnum::jurassic2Light())->first();
        if (!$jurassic2Light) {
            DB::table($table)->insert([
                'provider_id' => AIProvider::where('slug', AiProviderEnum::ai21()->value)->pluck('id')->first(),
                'slug' => AiTextModelEnum::jurassic2Light(),
                'name' => 'Jurassic-2 Light',
                'active' => true,
                'input_format' => 'text',
                'output_format' => 'text',
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }

        $jurassic2Mid = AIModel::where('slug', AiTextModelEnum::jurassic2Mid())->first();
        if (!$jurassic2Mid) {
            DB::table($table)->insert([
                'provider_id' => AIProvider::where('slug', AiProviderEnum::ai21()->value)->pluck('id')->first(),
                'slug' => AiTextModelEnum::jurassic2Mid(),
                'name' => 'Jurassic-2 Mid',
                'active' => true,
                'input_format' => 'text',
                'output_format' => 'text',
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }

        $jurassic2Ultra = AIModel::where('slug', AiTextModelEnum::jurassic2Ultra())->first();
        if (!$jurassic2Ultra) {
            DB::table($table)->insert([
                'provider_id' => AIProvider::where('slug', AiProviderEnum::ai21()->value)->pluck('id')->first(),
                'slug' => AiTextModelEnum::jurassic2Ultra(),
                'name' => 'Jurassic-2 Ultra',
                'active' => true,
                'input_format' => 'text',
                'output_format' => 'text',
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }

        $gpt35Turbo16k = AIModel::where('slug', AiTextModelEnum::gpt3_5Turbo16k())->first();
        if (!$gpt35Turbo16k) {
            DB::table($table)->insert([
                'provider_id' => AIProvider::where('slug', AiProviderEnum::openai()->value)->pluck('id')->first(),
                'slug' => AiTextModelEnum::gpt3_5Turbo16k(),
                'name' => 'GPT 3.5 Turbo 16K',
                'active' => true,
                'input_format' => 'text',
                'output_format' => 'text',
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }

        $claude2 = AIModel::where('slug', AiTextModelEnum::claude2())->first();
        if (!$claude2) {
            DB::table($table)->insert([
                'provider_id' => AIProvider::where('slug', AiProviderEnum::anthropic()->value)->pluck('id')->first(),
                'slug' => AiTextModelEnum::claude2(),
                'name' => 'Claude-2',
                'active' => true,
                'input_format' => 'text',
                'output_format' => 'text',
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }

        $ai21Summarize = AIModel::where('slug', AiTextModelEnum::ai21Summarize())->first();
        if (!$ai21Summarize) {
            DB::table($table)->insert([
                'provider_id' => AIProvider::where('slug', AiProviderEnum::ai21()->value)->pluck('id')->first(),
                'slug' => AiTextModelEnum::ai21Summarize(),
                'name' => 'Summarize',
                'active' => true,
                'input_format' => 'text',
                'output_format' => 'text',
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }
    }
}
