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
        Schema::create('button_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('notes')->nullable();
            $table->string('text_button', 100);
            $table->foreignId('reply_message_id')->constrained('messages');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('button_messages');
    }
};
