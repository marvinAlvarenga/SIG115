<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('numSe', 15);
            $table->string('numInv', 16);
            $table->string('marca', 20);
            $table->string('modelo', 50);
            $table->integer('estado');
            $table->integer('tipo');
            $table->integer('garantia');
            $table->date('fechaAdqui');
            $table->integer('employee_id');
            $table->float('valorAdqui', 8, 2);

            $table->unsignedInteger('id2')->index()->nullable($value = true);
            $table->foreign('id2')->references('id')->on('employees');

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
        Schema::dropIfExists('products');
    }
}
