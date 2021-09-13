<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 80)->comment('Nombre Producto');
            $table->enum('status', ['active', 'inactive'])->comment('estado del producto');
            $table->float('value', 10, 2)->default(0)->nullable(false)->comment("valor unitario");
            $table->string('url', 255)->comment('ruta de la imagen del producto');
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
        Schema::dropIfExists('products');
    }
}
