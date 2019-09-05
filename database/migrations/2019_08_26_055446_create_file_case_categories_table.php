<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileCaseCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_case_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('case_id')->nullable()->unsigned();
            $table->bigInteger('case_category_id')->nullable()->unsigned();
            $table->date('date')->nullable();
            $table->timestamps();
            $table->foreign('case_id')->references('id')->on('cases')->onDelete('cascade');
            $table->foreign('case_category_id')->references('id')->on('case_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_case_categories');
    }
}
