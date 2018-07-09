<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->integer('id')->unsigned()->unique();
            $table->integer('can_login')->unsigned();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('display_name')->nullable();
            $table->string('work_type')->nullable();
            $table->integer('age')->unsigned()->nullable();
            $table->date('birthday')->nullable();
            $table->date('startw_date')->nullable();
            $table->date('endw_date')->nullable();
            $table->enum('work_status', ['type1', 'type2'])->default('type1');
            $table->integer('department_id')->unsigned();
            $table->integer('employee_type_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('employees');
    }

}
