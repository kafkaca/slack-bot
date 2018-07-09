<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVacationBalanceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vacation_balance', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('employee_id')->unsigned();
			$table->integer('kalan')->default(0);
			$table->integer('kullanilan')->default(0);
			$table->integer('total')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('vacation_balance');
	}

}
