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
        Schema::create('antrians', function (Blueprint $table) {
            $table->id();
         
            $table->unsignedBigInteger('delivery_id');
            $table->foreign('delivery_id')->references('id')->on('delivery_orders')->onDelete('cascade');
            
            $table->string('nomor_kendaraan');
            $table->string('nama_pengemudi');
            $table->dateTime('waktu_kedatangan');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antrians');
    }
};
