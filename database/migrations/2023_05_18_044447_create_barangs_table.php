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
        Schema::create('barangs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_supplier');
            $table->string('nama_barang');
            $table->string('stok_barang');
            $table->string('harga_barang');
            $table->timestamps();
            $table->softDeletes()->nullable();

            // $table->foreign('id_supplier')->references('id')->on('suppliers')->onDelete('restrict');
            $table->foreign('id_supplier')->references('id')->on('suppliers')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
