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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('author')->nullable();
            $table->foreignId('language_id')->constrained('languages', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('genre_id')->constrained('genres', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('user_id')->constrained('users', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('page_count')->nullable()->default(0);
            $table->string('book_url')->nullable();
            $table->string('cover')->nullable();
            $table->integer('views')->nullable()->default(0);
            $table->integer('downloaded_times')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
