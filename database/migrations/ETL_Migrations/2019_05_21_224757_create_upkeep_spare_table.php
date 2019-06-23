<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUpkeepSpareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('STDB')->create('upkeep_spare', function (Blueprint $table) {
            $table->unsignedInteger('spare_id')->index();
            $table->foreign('spare_id')->references('id')->on('spares');
            $table->unsignedInteger('upkeep_id')->index();
            $table->foreign('upkeep_id')->references('id')->on('upkeeps');

            $table->primary(['spare_id', 'upkeep_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('upkeep_spare');
    }
}
