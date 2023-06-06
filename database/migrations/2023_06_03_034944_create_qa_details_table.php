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
        Schema::create('qa_details', function (Blueprint $table) {
            $table->id();            
            $table->foreignId('qa_id')->constrained('q_a_s')->onDelete('cascade');
            $table->integer('parent_id')->nullable();
            $table->string('has_children')->nullable();
            $table->text('judul')->nullable();            
            $table->text('keterangan')->nullable();
            $table->string('type')->nullable();            
            $table->string('validasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qa_details');
    }
};
