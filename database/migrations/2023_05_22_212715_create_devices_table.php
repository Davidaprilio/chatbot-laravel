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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('token');
            $table->string('label');
            $table->foreignId('server_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->string('deviceless')->nullable();
            $table->foreignId('flow_chat_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name')->nullable();
            $table->string('webhook')->nullable();
            $table->string('phone')->nullable();
            $table->string('image')->nullable();
            $table->enum('status', [
                'AUTHENTICATED',
                'NOT AUTHENTICATED'
            ])->default('NOT AUTHENTICATED');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
