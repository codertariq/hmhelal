<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaseHearingDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_hearing_dates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('case_id')->nullable()->unsigned();
            $table->date('date')->nullable();
            $table->text('note')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();
            $table->foreign('case_id')->references('id')->on('cases')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('case_hearing_dates');
    }
}
