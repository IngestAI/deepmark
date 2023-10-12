<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\PromptRequestStatusEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prompt_requests', function (Blueprint $table) {
            $table->id();
            $table->text('prompt')->nullable();
            $table->json('data')->nullable();
            $table->unsignedBigInteger('task_id')->default(null);
            $table->foreign('task_id', 'fk_prompt_request_task')
                ->references('id')
                ->on('tasks')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('model_id')->default(null);
            $table->foreign('model_id', 'fk_prompt_request_a_i_models')
                ->references('id')
                ->on('a_i_models')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->enum('status', array_keys(PromptRequestStatusEnum::toArray()))->nullable();
            $table->unsignedInteger('position')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prompts');
    }
};
