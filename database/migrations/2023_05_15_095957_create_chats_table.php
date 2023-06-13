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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chat_session_id')->constrained('chat_sessions');
            $table->string('message_id');
            $table->foreignId('reference_message_id')->nullable()->constrained('messages')->nullOnDelete();
            $table->string('timestamp');
            $table->string('attachment')->nullable();
            $table->enum('type', [
                'prompt',
                'chat',
            ])->default('chat');
            $table->boolean('from_me');
            $table->longText('text')->nullable();
            $table->string('response')->nullable()->comment('saved value if message is clickable response');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
