<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('table_category_posts', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained('table_post')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('table_category')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_category_posts');
    }
};
