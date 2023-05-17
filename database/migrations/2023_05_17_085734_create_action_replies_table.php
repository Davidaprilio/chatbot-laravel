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
            ]);
            $table->bigInteger('prompt_message_id')->foreignId('message_id')->nullable();
            $table->string('prompt_response')->nullable();
            $table->bigInteger('reply_message_id')->foreignId('message_id');
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
