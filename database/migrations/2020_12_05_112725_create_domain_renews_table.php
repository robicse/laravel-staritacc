<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainRenewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domain_renew', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('domain_id')->unsigned();
            $table->string('renew_date')->nullable();
            $table->string('expired_date')->nullable();
            $table->string('remarks')->nullable();
            $table->foreign('domain_id')->references('id')->on('domains')->onDelete('cascade');
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
        Schema::dropIfExists('domain_renew');
    }
}
