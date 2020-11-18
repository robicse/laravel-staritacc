<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('service_sale_id')->unsigned();
            $table->bigInteger('customer_id')->unsigned();
            $table->string('total_amount')->nullable();
            $table->string('paid_amount')->nullable();
            $table->string('due_amount')->nullable();
            $table->foreign('service_sale_id')->references('id')->on('service_sales')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dues');
    }
}
