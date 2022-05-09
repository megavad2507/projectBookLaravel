<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderSku extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_sku', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('sku_id');
            $table->integer('quantity')->default(1);
            $table->double('price');
            $table->timestamps();
        });
        Schema::dropIfExists('order_product');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('product_sku', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('product_id');
            $table->integer('quantity')->default(1);
            $table->double('price');
            $table->timestamps();
        });
        Schema::dropIfExists('order_sku');
    }
}
