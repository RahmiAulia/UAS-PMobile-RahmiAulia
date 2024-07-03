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
        Schema::create('ulasans', function (Blueprint $table) {
            $table->increments('id_ulasan');
            $table->unsignedInteger('id_produk');
            $table->unsignedInteger('id_pengguna');
            $table->foreign('id_produk')->references('id_produk')->on('produks')->onDelete('cascade');
            $table->foreign('id_pengguna')->references('id_pengguna')->on('penggunas')->onDelete('cascade');
            $table->string('ulasan', 160);
            $table->enum('rating', ['1', '2', '3', '4', '5']);
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
        Schema::dropIfExists('ulasans');
    }
};