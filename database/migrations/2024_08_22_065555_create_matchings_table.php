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
        Schema::create('matchings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_undian');
            $table->unsignedBigInteger('id_putaran');

            $table->unsignedBigInteger('id_jalur_kiri');
            $table->unsignedBigInteger('id_jalur_kanan');
            $table->unsignedInteger('id_jalur_menang')->nullable();

            $table->bigInteger('urutan_hilir');
            $table->bigInteger('hari')->default(1);

            $table->boolean('is_bay')->default(false);

            $table->foreign('id_undian')->references('id')->on('lotteries')->onDelete('cascade');
            $table->foreign('id_putaran')->references('id')->on('rounds')->onDelete('cascade');
            $table->foreign('id_jalur_kiri')->references('id')->on('jalur')->onDelete('cascade');
            $table->foreign('id_jalur_kanan')->references('id')->on('jalur')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matchings');
    }
};