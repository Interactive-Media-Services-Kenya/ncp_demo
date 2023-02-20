<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRejectWinnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reject_winners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('draw_winner_id')->nullable();
            // $table->foreign('draw_winner_id', 'draw_winner_id_fk_5609809')->references('id')->on('draw_winners');
            $table->unsignedBigInteger('rejected_by')->nullable();
            // $table->foreign('rejected_by', 'rejected_by_fk_5609809')->references('id')->on('users');
            $table->unsignedBigInteger('reject_id')->nullable();
            // $table->foreign('reject_id', 'reject_id_fk_5609809')->references('id')->on('rejects');
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
        Schema::dropIfExists('reject_winners');
    }
}
