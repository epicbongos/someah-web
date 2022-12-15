<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableSalariesDetailsAddGapok extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('salaries_details', function (Blueprint $table) {
            $table->bigInteger('gapok')->after('employee_id')->default(0);
            $table->bigInteger('tunj_jabatan')->after('gapok')->default(0);

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
            $table->dropColumn('gapok');
            $table->dropColumn('tunj_jabatan');

        });
    }
}
