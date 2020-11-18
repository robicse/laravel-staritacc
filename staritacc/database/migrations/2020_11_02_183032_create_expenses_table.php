<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('expense_category_id')->unsigned();
            $table->enum('payment_type',['cash','check']);
            $table->string('check_number')->nullable();
            $table->float('amount', 8,2);
            $table->string('date')->nullable();
            $table->string('year')->nullable();
            $table->string('month')->nullable();
            $table->timestamps();
            $table->foreign('expense_category_id')->references('id')->on('expense_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
}
