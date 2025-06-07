<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('forum_votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('forum_id')->constrained('forum')->onDelete('cascade');
            $table->enum('type', ['upvote', 'downvote']);
            $table->timestamps();
            $table->unique(['user_id', 'forum_id']); // 1 user hanya 1 vote per forum
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('forum_votes');
    }
};