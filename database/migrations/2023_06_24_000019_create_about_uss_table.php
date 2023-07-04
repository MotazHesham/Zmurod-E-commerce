<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutUssTable extends Migration
{
    public function up()
    {
        Schema::create('about_uss', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('vision')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('phone_number_2')->nullable();
            $table->decimal('normal_shipment_cost', 15, 2);
            $table->decimal('fast_shipment_cost', 15, 2);
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
