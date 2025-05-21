<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('table_comment', static function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->text('content');
            $table->foreignId('user_id')->constrained('table_user')->onDelete('cascade');
            $table->foreignId('post_id')->constrained('table_post')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_comment');
    }
};
