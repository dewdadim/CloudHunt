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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('xp')->default(0);
        });

        Schema::table('progresses', function (Blueprint $table) {
            $table->unsignedInteger('xp_earned')->default(0);
            $table->decimal('accuracy', 5, 2)->nullable();
            $table->integer('time_spent')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('xp');
        });

        Schema::table('progresses', function (Blueprint $table) {
            $table->dropColumn(['xp_earned', 'accuracy', 'time_spent']);
        });
    }
};
