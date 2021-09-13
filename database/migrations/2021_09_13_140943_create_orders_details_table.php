<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->comment('Foránea a Productos');
            $table->foreign('product_id')->references('id')->on('products');
            $table->unsignedBigInteger('order_id')->comment('Foránea a Orden');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->float('amount', 10, 2)->default(0)->nullable(false)->comment("cantidad");
            $table->float('value', 10, 2)->default(0)->nullable(false)->comment("valor unitario");
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
        Schema::dropIfExists('orders_details');
    }
}
