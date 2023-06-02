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
        Schema::create('kontaks', function (Blueprint $table) {
            $table->id();
            $table->string('sapaan')->nullable();
            $table->string('panggilan')->nullable();
            $table->string('nama');
            $table->string('tanggal_lahir')->nullable();
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('kategori');
            $table->string('agama')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kota')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('alamat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontaks');
    }
};
