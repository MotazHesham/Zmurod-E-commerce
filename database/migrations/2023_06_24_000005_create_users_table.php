<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('password')->nullable();
            $table->datetime('email_verified_at')->nullable();
            $table->string('remember_token')->nullable();
            $table->string('user_type')->default('staff');
            $table->text('country');
            $table->string('phone');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
