<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductReleaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_release', function (Blueprint $table) {
            $table->unsignedInteger('release_id')->index();
            $table->foreign('release_id')->references('id')->on('releases');
            $table->unsignedInteger('product_id')->index();
            $table->foreign('product_id')->references('id')->on('products');

            $table->primary(['release_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_release');
    }
}
