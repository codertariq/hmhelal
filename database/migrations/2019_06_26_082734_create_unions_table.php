<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnionsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('unions', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->bigInteger('division_id')->nullable()->unsigned();
			$table->foreign('division_id')->references('id')->on('divisions')->onDelete('cascade');
			$table->bigInteger('district_id')->nullable()->unsigned();
			$table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
			$table->bigInteger('upozila_id')->nullable()->unsigned();
			$table->foreign('upozila_id')->references('id')->on('upozilas')->onDelete('cascade');
			$table->string('name')->nullable();
			$table->text('options')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('unions', function (Blueprint $table) {
			$table->dropForeign('unions_division_id_foreign');
			$table->dropForeign('unions_district_id_foreign');
			$table->dropForeign('unions_upozila_id_foreign');
		});
		Schema::dropIfExists('unions');
	}
}
