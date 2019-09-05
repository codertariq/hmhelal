<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpozilasTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('upozilas', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->bigInteger('division_id')->nullable()->unsigned();
			$table->foreign('division_id')->references('id')->on('divisions')->onDelete('cascade');
			$table->bigInteger('district_id')->nullable()->unsigned();
			$table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
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
		Schema::table('upozilas', function (Blueprint $table) {
			$table->dropForeign('upozilas_division_id_foreign');
			$table->dropForeign('upozilas_district_id_foreign');
		});
		Schema::dropIfExists('upozilas');
	}
}
