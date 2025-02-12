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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('language_id'); // Foreign key column
                 // Add the foreign key constraint
            $table->foreign('language_id')
                ->references('id')
                ->on('language')
                ->onDelete('cascade');
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            $table->string('top_store')->default(0)->nullable();
            $table->string('url')->nullable();
            $table->string('destination_url');
            $table->string('category')->nullable();
            $table->string('status');
            $table->string('authentication')->nullable();
            $table->string('network')->nullable();
            $table->string('store_image')->nullable();
            $table->softDeletes();
             $table->string('title')->nullable();
            $table->longText('meta_tag')->nullable();
            $table->longText('meta_keyword')->nullable();
            $table->longText('meta_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
        Schema::table('stores', function (Blueprint $table) {
            $table->dropSoftDeletes(); // Removes 'deleted_at' column
        });
    }
};
