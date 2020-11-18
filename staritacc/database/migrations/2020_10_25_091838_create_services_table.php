<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('service_category_id')->unsigned();
            $table->bigInteger('service_unit_id')->unsigned();
            $table->bigInteger('service_sub_category_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('image')->default('default.jpg');
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->foreign('service_category_id')->references('id')->on('service_categories')->onDelete('cascade');
            $table->foreign('service_unit_id')->references('id')->on('service_units')->onDelete('cascade');
            $table->foreign('service_sub_category_id')->references('id')->on('service_sub_categories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
