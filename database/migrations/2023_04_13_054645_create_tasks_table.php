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
        if (! Schema::hasTable('tasks')) {
            Schema::create('tasks', function (Blueprint $table) {
                $table->id();
                $table->uuid('uuid')->index();
                $table->string('name');
                $table->text('body')->nullable();
                $table->uuid('space_id');
                $table->uuid('task_id')->nullable();
                $table->string('status')->default('to-do');
                $table->string('type')->index();
                $table->uuid('user_id');
                $table->dateTime('estimated_date')->nullable();
                $table->dateTime('start_date')->nullable();
                $table->dateTime('end_date')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('tasks')) {
            Schema::dropIfExists('tasks');
        }
    }
};
