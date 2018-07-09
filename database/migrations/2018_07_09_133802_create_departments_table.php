<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDepartmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('departments', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->text('name');
			$table->integer('isd_count')->default(1)->comment('aynı tarihte max çalışan');
			$table->integer('dt_wait')->default(30)->comment('izin öncesi beklemesi gereken süre');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('departments');
	}

}
