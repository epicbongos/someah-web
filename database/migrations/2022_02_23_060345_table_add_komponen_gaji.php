<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableAddKomponenGaji extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('salaries_details', function (Blueprint $table) {
            $table->bigInteger('tunj_transport')->after('tunj_hari_raya')->default(0);
            $table->bigInteger('kehadiran_potongan')->after('total_potongan')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('salaries_details', function (Blueprint $table) {
            $table->dropColumn('tunj_transport');
            $table->dropColumn('kehadiran_potongan');
        });
    }
}