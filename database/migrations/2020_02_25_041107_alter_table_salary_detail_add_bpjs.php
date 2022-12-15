<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableSalaryDetailAddBpjs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('salaries_details', function (Blueprint $table) {
            $table->bigInteger('tunj_bpjs_kes')->after('total_gaji')->default(0);
            $table->bigInteger('tunj_bpjs_jkk')->after('tunj_bpjs_kes')->default(0);
            $table->bigInteger('tunj_bpjs_jkm')->after('tunj_bpjs_jkk')->default(0);
            $table->bigInteger('tunj_bpjs_jht')->after('tunj_bpjs_jkm')->default(0);
            $table->bigInteger('tunj_hari_raya')->after('tunj_bpjs_jht')->default(0);

            //potongan
            $table->bigInteger('pph21')->after('tunj_hari_raya')->default(0);
            $table->bigInteger('iuran_bpjs_someah')->after('pph21')->default(0);
            $table->bigInteger('iuran_bpjs_jkk')->after('iuran_bpjs_someah')->default(0);
            $table->bigInteger('iuran_bpjs_jht')->after('iuran_bpjs_jkk')->default(0);
            $table->bigInteger('total_potongan')->after('iuran_bpjs_jht')->default(0);
            $table->text('terbilang')->after('transferred')->nullable();
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
            $table->dropColumn('tunj_bpjs_kes');
            $table->dropColumn('tunj_bpjs_jkk');
            $table->dropColumn('tunj_bpjs_jkm');
            $table->dropColumn('tunj_bpjs_jht');
            $table->dropColumn('tunj_hari_raya');
            $table->dropColumn('pph21');
            $table->dropColumn('iuran_bpjs_someah');
            $table->dropColumn('iuran_bpjs_jkk');
            $table->dropColumn('iuran_bpjs_jht');
            $table->dropColumn('total_potongan');
            $table->dropColumn('terbilang');
        });
    }
}
