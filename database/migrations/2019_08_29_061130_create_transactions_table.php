<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('trans_date');
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->unsignedBigInteger('chart_account_id')->nullable();
            $table->decimal('amount',8,2);
            $table->string('dr_cr',2)->nullable();
            $table->string('trans_type')->nullable();
            $table->unsignedBigInteger('payee_payer_id')->nullable();
            $table->integer('payment_method')->nullable();
            $table->integer('create_user_id');
            $table->integer('update_user_id')->nullable();
            $table->string('reference',100)->nullable();
            $table->text('attachment')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
            $table->foreign('bank_id')
                ->references('id')
                ->on('banks')
                ->onDelete('cascade');
            $table->foreign('chart_account_id')
                ->references('id')
                ->on('chart_accounts')
                ->onDelete('cascade'); 
            $table->foreign('payee_payer_id')
                ->references('id')
                ->on('payee_payers')
                ->onDelete('cascade');       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
