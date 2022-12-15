<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableSalaryDetailAddIuranBpjs1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('salaries_details', function (Blueprint $table) {
            $table->bigInteger('iuran_bpjs_kes1')->after('iuran_bpjs_someah')->default(0);
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
            $table->dropColumn('iuran_bpjs_kes1');
        });
    }
}