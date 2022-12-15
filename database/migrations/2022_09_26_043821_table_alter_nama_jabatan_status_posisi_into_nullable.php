<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableAlterNamaJabatanStatusPosisiIntoNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('positions', function (Blueprint $table) {
            $table->string('nama_jabatan')->nullable(true)->change();
            $table->string('status_posisi')->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('positions', function (Blueprint $table) {
            $table->dropColumn('nama_jabatan')->nullable(false)->change();
            $table->dropColumn('status_posisi')->nullable(false)->change();
        });
    }
}
