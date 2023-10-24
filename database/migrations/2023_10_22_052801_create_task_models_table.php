<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('task_models', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_id')->default(null);
            $table->foreign('task_id', 'fk_task_models_task')
                ->references('id')
                ->on('tasks')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('model_id')->default(null);
            $table->foreign('model_id', 'fk_task_models_a_i_models')
                ->references('id')
                ->on('a_i_models')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->json('match')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_models');
    }
};
