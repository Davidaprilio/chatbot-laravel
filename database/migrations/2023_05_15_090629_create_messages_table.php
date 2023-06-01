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
                'custom_condition', 
                'anon_customer', 
                'before_send_menu',
                'after_send_menu',
                'after_give_name',
                'dont_understand',
                'end_menu',
                'end_chat',
                'confirm_not_response',
                'close_chat_not_response',
            ])->nullable();
            $table->string('condition')->nullable(); // bisa menyetel sendiri pengecekan data di db misal 'customers.name=null'
            $table->enum('condition_type', [
                'skip_to_message',
                'skip_to_next_message',
                'skip_and_next_message',
            ])->nullable();
            $table->string('condition_value')->nullable();
            $table->enum('trigger_event', [
                'show_menu',
                'close_chat',
                'save_response',
            ])->nullable();
            $table->string('event_value')->nullable();
            $table->string('title')->default('Untitled message');
            $table->longText('text');
            $table->enum('type', [
                'prompt',
                'chat',
            ])->default('chat');
            // next_message foreign to id 
            $table->integer('order_sending')->default(0);
            $table->foreignId('next_message')->nullable()->constrained(table: 'messages');
            $table->json('response_true')->nullable();
            $table->json('response_false')->nullable();
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
