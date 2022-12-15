<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('salary_id');
            $table->integer('employee_id');
            $table->bigInteger('bonus')->default(0);
            $table->bigInteger('insentif_project')->default(0);
            $table->bigInteger('reimburse')->default(0);
            $table->bigInteger('lembur')->default(0);
            $table->bigInteger('total_gaji')->default(0);
            $table->bigInteger('salary_cut')->default(0);
            $table->bigInteger('transferred')->default(0);
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('salaries_details');
    }
}
