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
        Schema::table('categories', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('updated_id')->nullable()->constrained('users')->nullOnDelete();
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('updated_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('language_id')->nullable()->constrained('language')->nullOnDelete();
        });

        Schema::table('stores', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('updated_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
        });

        Schema::table('coupons', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('updated_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('store_id')->constrained()->nullOnDelete();
        });

        Schema::table('sliders', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('updated_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->foreignId('language_id')->nullable()->constrained('language')->nullOnDelete();
             $table->foreignId('store_id')->nullable()->constrained('stores')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['updated_id']);
            $table->dropColumn(['user_id', 'updated_id']);
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['updated_id']);
            $table->dropForeign(['language_id']);
            $table->dropColumn(['user_id', 'updated_id', 'language_id']);
        });

        Schema::table('stores', function (Blueprint $table) {
            $table->dropForeign(['updated_id']);
            $table->dropForeign(['category_id']);
            $table->dropForeign(['user_id']);
            $table->dropColumn(['updated_id', 'category_id','user_id']);
        });

        Schema::table('coupons', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['updated_id']);
            $table->dropForeign(['store_id']);
            $table->dropColumn(['user_id', 'updated_id', 'store_id']);
        });

        Schema::table('sliders', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['updated_id']);
            $table->dropForeign(['category_id']);
            $table->dropForeign(['language_id']);
            $table->dropColumn(['user_id', 'updated_id', 'category_id', 'language_id']);
        });
    }
};
