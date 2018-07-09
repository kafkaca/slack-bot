<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVacationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vacations', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('employee_id')->unsigned();
			$table->date('vacation_start');
			$table->date('vacation_end');
			$table->integer('vacation_type_id')->unsigned();
			$table->text('employee_note')->nullable();
			$table->text('result_note')->nullable();
			$table->enum('status', ['pending', 'success', 'cancel'])->default('pending');
			$table->date('request_at')->nullable();
			$table->integer('updated_by')->unsigned()->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->index(['vacation_start','vacation_end']);
			$table->unique(['employee_id','status']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('vacations');
	}

}
