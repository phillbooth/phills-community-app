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
        Schema::table('comments', function (Blueprint $table) {
            // Only add the column if it doesn't already exist
            if (!Schema::hasColumn('comments', 'article_id')) {
                $table->uuid('article_id');
                $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            }
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            // Remove the foreign key constraint first
            $table->dropForeign(['article_id']);
            // Then drop the column
            $table->dropColumn('article_id');
        });
    }
    
};
