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
        if (! Schema::hasTable('timelines')) {
            Schema::create('timelines', function (Blueprint $table) {
                $table->id();
                $table->morphs('timelineable');
                $table->uuid('user_id');
                $table->string('action');
                $table->string('detail');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('timelines')) {
            Schema::dropIfExists('timelines');
        }
    }
};
