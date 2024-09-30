<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_num')->nullable();
            $table->string('client_name');
            $table->string('phone_number');
            $table->string('phone_number_2');
            $table->longText('shipping_address');
            $table->string('delivery_status');
            $table->decimal('total_cost', 15, 2)->nullable();
            $table->decimal('discount', 15, 2)->nullable();
            $table->string('shipment_type');
            $table->string('city');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
