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
        Schema::create('shippings', function (Blueprint $table) {
            $table->increments('id_shipping');
            $table->unsignedInteger('id_transaksi');
            $table->unsignedInteger('id_pembayaran');
            $table->foreign('id_transaksi')->references('id_transaksi')->on('transaksis')->onDelete('cascade');
            $table->foreign('id_pembayaran')->references('id_pembayaran')->on('pembayarans')->onDelete('cascade');
            $table->decimal('biaya');
            $table->enum('status',['dikirim', 'selesai']);
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
        Schema::dropIfExists('shippings');
    }

};
