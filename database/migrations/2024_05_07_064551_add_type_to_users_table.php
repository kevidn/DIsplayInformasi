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
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('type')->default(0); // Users: 0=>User, 1=>Admin, 2=>Manager
            $table->string('quotes')->default('Kamu Bisa Menambahkan Kata Kata Mutiara mu Disini!...');
            $table->string('gambarakun')->default('/images/defaultakun.jpeg');
            $table->string('gambarlatar')->default('/images/defaultlatar.jpg');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
