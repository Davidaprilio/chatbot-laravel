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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->enum('hook', [
                'welcome',
                'before_send_menu',
                'after_send_menu',
                'after_give_name',                
                'end_chat',
            ])->nullable();
            $table->longText('text');
            $table->enum('type', [
                'prompt',
                'chat',
            ])->default('chat');
            $table->string('attachment')->nullable();
            $table->json('buttons')->nullable();
            $table->json('lists')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
