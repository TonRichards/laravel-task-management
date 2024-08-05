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
        if (! Schema::hasTable('spaces')) {
            Schema::create('spaces', function (Blueprint $table) {
                $table->id();
                $table->uuid('uuid')->index();
                $table->string('name');
                $table->uuid('space_id')->nullable();
                $table->string('type')->index();
                $table->uuid('user_id');
                $table->json('statuses')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        };
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('spaces')) {
            Schema::dropIfExists('spaces');
        }
    }
};
