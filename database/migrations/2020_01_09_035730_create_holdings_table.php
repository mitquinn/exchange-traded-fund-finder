<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoldingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holdings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('exchange_traded_fund_id')->unsigned()->index()->nullable();
            $table->foreign('exchange_traded_fund_id')->references('id')->on('exchange_traded_funds');
            $table->string('type');
            $table->json('data');
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('holdings');
        Schema::enableForeignKeyConstraints();
    }
}
