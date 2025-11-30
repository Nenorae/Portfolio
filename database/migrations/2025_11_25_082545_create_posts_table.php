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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('caption')->nullable();
            $table->string('image')->nullable(); // Path gambar
            $table->string('github_link')->nullable(); // Link ke GitHub
            $table->string('demo_link')->nullable(); // Link demo/portfolio
            $table->string('category')->nullable(); // Contoh: "IoT", "Web App"
            $table->integer('likes_count')->default(0);
            $table->timestamps();
            
            $table->index('user_id');
            $table->index('created_at');
            $table->index('category'); // Agar filter kategori cepat
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};