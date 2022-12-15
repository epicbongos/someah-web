<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableTipeProjectAddGambarDeskripsi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tipe_projects', function (Blueprint $table) {
            $table->string('gambar')->after('slug');
            $table->text('desc')->after('gambar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tipe_projects', function (Blueprint $table) {
            $table->dropColumn('gambar');
            $table->dropColumn('desc');
        });
    }
}
