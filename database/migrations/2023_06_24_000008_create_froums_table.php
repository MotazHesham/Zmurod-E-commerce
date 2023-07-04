<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFroumsTable extends Migration
{
    public function up()
    {
        Schema::create('froums', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->longText('description');
            $table->string('category');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
