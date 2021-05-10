<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderFoodTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_food_tables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('bill_detail_id');
            $table->unsignedBigInteger('table_id');
            $table->date('date_order_to');
            $table->string('time_order',255);
            $table->integer('status');
            $table->foreign('bill_detail_id')->references('id')->on('bill_details')->onDelete('cascade');
            $table->foreign('table_id')->references('id')->on('tables')->onDelete('cascade');
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
        Schema::dropIfExists('order_food_tables');
    }
}