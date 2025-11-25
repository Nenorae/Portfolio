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
            $table->integer('followers_count')->default(0)->after('website');
            $table->integer('following_count')->default(0)->after('followers_count');
            $table->integer('posts_count')->default(0)->after('following_count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['followers_count', 'following_count', 'posts_count']);
        });
    }
};