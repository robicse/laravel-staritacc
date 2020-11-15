<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('employee_id')->unsigned();
            $table->string('month');
            $table->string('year');
            $table->string('attendance')->nullable();
            $table->string('present')->nullable();
            $table->string('gross_salary')->nullable();
            $table->string('basic_salary')->nullable();
            $table->string('per_day_salary')->nullable();
            $table->string('OT_hour')->nullable();
            $table->string('OT_rate')->nullable();
            $table->string('total_over_time')->nullable();
            $table->string('attendance_bonus')->nullable();
            $table->string('tips')->nullable();
            $table->string('total_salary')->nullable();
            $table->string('advance_salary')->nullable();
            $table->string('uniform_value')->nullable();
            $table->string('uniform_advance')->nullable();
            $table->string('uniform_deduction')->nullable();
            $table->string('due_salary')->nullable();
            $table->string('net_payable_salary')->nullable();
            $table->timestamps();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salaries');
    }
}
