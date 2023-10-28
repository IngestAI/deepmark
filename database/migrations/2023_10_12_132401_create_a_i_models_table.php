<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Database\Seeders\AiModelSeeder;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('a_i_models', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('provider_id')->default(null);
            $table->foreign('provider_id', 'fk_provider_model')
                ->references('id')
                ->on('a_i_providers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('slug', 255)->unique();
            $table->string('name', 255)->index();
            $table->boolean('active')->default(false);
            $table->string('input_format', 255)->nullable();
            $table->string('output_format', 255)->nullable();
            $table->timestamps();
        });

        (new AiModelSeeder())->run();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('a_i_models');
    }
};
