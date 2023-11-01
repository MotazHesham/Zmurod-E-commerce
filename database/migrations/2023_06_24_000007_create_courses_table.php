<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description');
            $table->string('trainer');
            $table->date('start_at');
            $table->integer('courses_hours');
            $table->decimal('price', 15, 2)->nullable();
            $table->string('type');
            $table->boolean('approved')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
