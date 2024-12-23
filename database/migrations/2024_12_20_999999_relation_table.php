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
        Schema::table('types', function (Blueprint $table) {
            $table->foreign('id_merek')->references('id')->on('mereks')->onDelete('CASCADE');
        });

        Schema::table('barangs', function (Blueprint $table) {
            $table->foreign('id_merek')->references('id')->on('mereks')->onDelete('CASCADE');
            $table->foreign('id_type')->references('id')->on('types')->onDelete('CASCADE');
        });


        Schema::table('barang_masuks', function (Blueprint $table) {
            $table->foreign('id_barang')->references('id')->on('barangs')->onDelete('SET NULL');
            $table->foreign('id_distributor')->references('id')->on('distributors')->onDelete('SET NULL');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('SET NULL');
        });

        Schema::table('barang_keluars', function (Blueprint $table) {
            $table->foreign('id_barang')->references('id')->on('barangs')->onDelete('SET NULL');
            $table->foreign('id_distributor')->references('id')->on('distributors')->onDelete('SET NULL');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
