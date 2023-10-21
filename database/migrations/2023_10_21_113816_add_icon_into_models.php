<?php

use App\Services\Ai\Enums\AiTextModelEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('a_i_models', function (Blueprint $table) {
            $table->string('icon')
                ->nullable()
                ->after('name');
        });

        $this->fillUrls();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('a_i_models', function (Blueprint $table) {
            $table->dropColumn('icon');
        });
    }

    private function fillUrls()
    {
        $slugs = DB::table('a_i_models')->pluck('slug')->toArray();

        foreach ($slugs as $slug) {
            DB::table('a_i_models')->where('slug', $slug)->update(['icon' => $this->getIconByModel($slug)]);
        }
    }

    private function getIconByModel(string $slug)
    {
        return match ($slug) {
            (string) AiTextModelEnum::gpt3_5(),
            (string) AiTextModelEnum::gpt4(),
            (string) AiTextModelEnum::textDavinci003(),
            (string) AiTextModelEnum::textDavinci002(),
            (string) AiTextModelEnum::textAda001(),
            (string) AiTextModelEnum::gpt3_5Turbo16k(),
            (string) AiTextModelEnum::textBabbage001(),
            (string) AiTextModelEnum::textCurie001() => 'openai.svg',
            (string) AiTextModelEnum::claude1(),
            (string) AiTextModelEnum::claude1_100k(),
            (string) AiTextModelEnum::claudeInstant1(),
            (string) AiTextModelEnum::claude2() => 'anthropic_app_icon.png',
            (string) AiTextModelEnum::jurassic2Light(),
            (string) AiTextModelEnum::jurassic2Mid(),
            (string) AiTextModelEnum::jurassic2Ultra(),
            (string) AiTextModelEnum::ai21Summarize() => 'ai21.png',
            (string) AiTextModelEnum::generate(),
            (string) AiTextModelEnum::summarize() => 'generate-summarize.svg',
            default => null,
        };
    }
};
