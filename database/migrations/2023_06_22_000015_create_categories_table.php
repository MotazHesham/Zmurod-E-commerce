<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->boolean('most_recent')->default(0)->nullable();
            $table->boolean('fav')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
