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
        Schema::create('action_replies', function (Blueprint $table) {
            $table->id();
            $table->enum('type', [
                'prompt_await',
                'button_selected',
                'option_selected',
                'auto_reply',
                'skip_message'
            ]);
            $table->foreignId('prompt_message_id')->nullable()->constrained(table: 'messages');
            $table->string('prompt_response')->nullable();
            $table->foreignId('reply_message_id')->constrained(table: 'messages');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('action_replies');
    }
};
