<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasTable extends Migration
{
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('city');
            $table->decimal('shipping_cost', 15, 2);
            $table->boolean('active_area')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
