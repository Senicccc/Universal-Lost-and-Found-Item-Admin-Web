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
            if (!Schema::hasColumn('users', 'updated_at')) {
                $table->timestamp('updated_at')->nullable()->useCurrent();
            }
        });

        Schema::table('items', function (Blueprint $table) {
            if (!Schema::hasColumn('items', 'updated_at')) {
                $table->timestamp('updated_at')->nullable()->useCurrent();
            }
        });

        Schema::table('logs', function (Blueprint $table) {
            if (!Schema::hasColumn('logs', 'updated_at')) {
                $table->timestamp('updated_at')->nullable()->useCurrent();
            }
        });

        Schema::table('bookmarks', function (Blueprint $table) {
            if (!Schema::hasColumn('bookmarks', 'updated_at')) {
                $table->timestamp('updated_at')->nullable()->useCurrent();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'updated_at')) {
                $table->dropColumn('updated_at');
            }
        });

        Schema::table('items', function (Blueprint $table) {
            if (Schema::hasColumn('items', 'updated_at')) {
                $table->dropColumn('updated_at');
            }
        });

        Schema::table('logs', function (Blueprint $table) {
            if (Schema::hasColumn('logs', 'updated_at')) {
                $table->dropColumn('updated_at');
            }
        });

        Schema::table('bookmarks', function (Blueprint $table) {
            if (Schema::hasColumn('bookmarks', 'updated_at')) {
                $table->dropColumn('updated_at');
            }
        });
    }
};
