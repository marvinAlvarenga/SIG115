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
            $table->integer('estado')->default(1);
            $table->integer('tipo');
            $table->integer('garantia');
            $table->date('fechaAdqui');
           
            $table->float('valorAdqui', 8, 2);

            $table->unsignedInteger('employee_id')->index()->nullable($value = true);
            $table->foreign('employee_id')->references('id')->on('employees');

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
