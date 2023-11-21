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
        Schema::table('kembali', function (Blueprint $table) {
            $table->dropForeign(['users_id']);
            $table->dropForeign(['mobil_id']);
            $table->dropColumn(['users_id', 'mobil_id']);
            $table->unsignedBigInteger('pinjam_id');
            $table->foreign('pinjam_id')->references('id')->on('pinjam')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kembali', function (Blueprint $table) {
            //
        });
    }
};
