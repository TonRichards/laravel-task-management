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
        if (! Schema::hasColumns('users', ['number_of_attemp', 'block_until'])) {
            Schema::table('users', function (Blueprint $table) {
                $table->integer('number_of_attemp')->after('email')->default(0);
                $table->dateTime('block_until')->after('number_of_attemp')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumns('users', ['number_of_attemp', 'block_until'])) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('block_until');
                $table->dropColumn('number_of_attemp');
            });
        }
    }
};
