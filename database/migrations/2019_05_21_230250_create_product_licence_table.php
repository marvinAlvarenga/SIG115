<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductLicenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_licence', function (Blueprint $table) {
            $table->unsignedInteger('licence_id')->index();
            $table->foreign('licence_id')->references('id')->on('licences');
            $table->unsignedInteger('product_id')->index();
            $table->foreign('product_id')->references('id')->on('products');

            $table->primary(['licence_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_licence');
    }
}
