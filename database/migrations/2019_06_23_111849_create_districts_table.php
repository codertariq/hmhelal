<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistrictsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('districts', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->bigInteger('division_id')->nullable()->unsigned();
			$table->foreign('division_id')->references('id')->on('divisions')->onDelete('cascade');
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
		Schema::table('districts', function (Blueprint $table) {
			$table->dropForeign('districts_division_id_foreign');
		});
		Schema::dropIfExists('districts');
	}
}
