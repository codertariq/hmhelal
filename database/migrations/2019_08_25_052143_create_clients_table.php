<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->bigInteger('division_id')->nullable()->unsigned();
            $table->bigInteger('district_id')->nullable()->unsigned();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('gender')->nullable();
            $table->string('address')->nullable();
            $table->string('file')->nullable();
            $table->boolean('status')->default(1);

            $table->timestamps();
            $table->foreign('division_id')->references('id')->on('divisions')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
