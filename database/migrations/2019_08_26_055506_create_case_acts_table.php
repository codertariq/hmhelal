<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaseActsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_acts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('case_id')->nullable()->unsigned();
            $table->bigInteger('act_id')->nullable()->unsigned();
            $table->date('date')->nullable();
            $table->timestamps();
            $table->foreign('case_id')->references('id')->on('cases')->onDelete('cascade');
            $table->foreign('act_id')->references('id')->on('acts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('case_acts');
    }
}
