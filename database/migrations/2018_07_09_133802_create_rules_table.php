<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rules', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('rule_name');
			$table->jsonb('rule_data')->nullable()->comment('bazı kurallar');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('rules');
	}

}
