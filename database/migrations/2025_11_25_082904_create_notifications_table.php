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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Penerima notifikasi
            $table->foreignId('actor_id')->constrained('users')->onDelete('cascade'); // Yang melakukan aksi
            $table->enum('type', ['follow', 'like']); // Tipe notifikasi
            $table->foreignId('post_id')->nullable()->constrained()->onDelete('cascade'); // Jika tipe = like
            $table->boolean('is_read')->default(false);
            $table->timestamps();
            
            $table->index('user_id');
            $table->index('is_read');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};