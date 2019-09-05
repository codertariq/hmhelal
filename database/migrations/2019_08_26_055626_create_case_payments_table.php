<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('case_id')->nullable()->unsigned();
            $table->string('invoice_no')->nullable();
            $table->string('mode')->nullable();
            $table->double('amount',10,2)->nullable();
            $table->date('date')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('case_payments');
    }
}
