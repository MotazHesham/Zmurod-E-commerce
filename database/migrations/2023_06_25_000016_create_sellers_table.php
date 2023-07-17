<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellersTable extends Migration
{
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('phone');
            $table->string('country');
            $table->string('store_name');
            $table->longText('description');
            $table->boolean('featured_store')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
