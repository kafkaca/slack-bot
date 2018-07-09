<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeeTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employee_types', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('xtype');
			$table->integer('pv_days')->default(30)->comment('ücretli izin günleri');
			$table->integer('uv_days')->default(30)->comment('ücretsiz izin günleri');
			$table->jsonb('responsibilities')->nullable()->comment('bazı sorunluluklar');

		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('employee_types');
	}

}
