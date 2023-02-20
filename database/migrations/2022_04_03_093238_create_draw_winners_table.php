<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrawWinnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('draw_winners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('phone');
            $table->unsignedBigInteger('draw_id')->nullable();
            // $table->foreign('draw_id', 'draw_id_fk_5609809')->references('id')->on('draws');
            $table->string('code')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('draw_winners');
    }
}
