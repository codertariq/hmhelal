<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('case_no');
            $table->bigInteger('client_id')->nullable()->unsigned();
            $table->bigInteger('client_category_id')->nullable()->unsigned();
            $table->bigInteger('case_stage_id')->nullable()->unsigned();
            $table->bigInteger('court_category_id')->nullable()->unsigned();
            $table->bigInteger('court_id')->nullable()->unsigned();
            $table->string('filling_date')->nullable();
            $table->string('first_hearing_date')->nullable();
            $table->string('opposite_lawyer')->nullable();
            $table->double('fees',10,2)->nullable();
            $table->string('thana')->nullable();
            $table->string('denemee')->nullable();
            $table->enum('status',['Open','Pending','Close'])->nullable();
            $table->string('room_no')->nullable();
            $table->string('file_no')->nullable();
            $table->date('closing_date')->nullable();
            $table->date('receiving_date')->nullable();
            $table->date('judgement_date')->nullable();
            $table->date('note')->nullable();
            $table->string('close_status')->nullable();
            $table->timestamps();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('client_category_id')->references('id')->on('client_categories')->onDelete('cascade');
            $table->foreign('case_stage_id')->references('id')->on('case_stages')->onDelete('cascade');
            $table->foreign('court_category_id')->references('id')->on('court_categories')->onDelete('cascade');
            $table->foreign('court_id')->references('id')->on('courts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cases');
    }
}
