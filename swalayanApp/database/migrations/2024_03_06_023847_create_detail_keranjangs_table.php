<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('detail_keranjangs', function (Blueprint $table) {
            $table->increments('id_detail_keranjang');
            $table->unsignedInteger('id_keranjang');
            $table->unsignedInteger('id_produk');
            $table->foreign('id_keranjang')->references('id_keranjang')->on('keranjangs')->onDelete('cascade');
            $table->foreign('id_produk')->references('id_produk')->on('produks')->onDelete('cascade');
            $table->integer('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_keranjangs');
    }

};
