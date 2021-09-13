<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name', 80)->comment('Nombre Cliente');
            $table->string('customer_email', 120)->comment('Correo Cleinte');
            $table->string('customer_mobile', 40)->comment('telefono cliente');
            $table->enum('status', ['CREATED', 'PAYED', 'REJECTED'])->comment('estado del pago');
            $table->float('total', 10, 2)->default(0)->nullable(false)->comment("total");
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
        Schema::dropIfExists('orders');
    }
}
