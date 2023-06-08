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
        Schema::create('chat_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id');
            $table->foreignId('device_id');
            $table->string('phone_device');
            $table->tinyInteger('alert_close')->default(0)->comment('0: send confirm not response, 1: send close chat not response');
            $table->dateTime('ended_at')->nullable()->comment('null if session is still active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_sessions');
    }
};
