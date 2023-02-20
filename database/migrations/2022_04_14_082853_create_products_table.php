<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('serial');
            $table->unsignedBigInteger('product_category_id')->nullable();
            // $table->foreign('product_category_id', 'product_category_id_fk_5609809')->references('id')->on('product_categories');
            $table->unsignedBigInteger('batch_id')->nullable();
            // $table->foreign('batch_id', 'batch_id_fk_5609809')->references('id')->on('batches');
            $table->unsignedBigInteger('company_id')->nullable();
            // $table->foreign('company_id', 'company_id_fk_5609809')->references('id')->on('companies');
            $table->integer('issued_status')->default(0);
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
