<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bukti_transfer', function (Blueprint $table) {
            $table->id();
            $table->integer('transaction_id');
            $table->string('gambar');
            $table->string('status');
            $table->string('bank_refund')->nullable();
            $table->string('rek_refund')->nullable();
            $table->string('nama_refund')->nullable();
            $table->string('bukti_refund')->nullable();
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
        Schema::dropIfExists('bukti_transfer');
    }
};
