<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPostsTable extends Migration
{
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('author_id')->nullable();
            $table->foreign('author_id', 'author_fk_8640280')->references('id')->on('users');
            $table->unsignedBigInteger('post_forum_id')->nullable();
            $table->foreign('post_forum_id', 'post_forum_fk_9087638')->references('id')->on('froums');
        });
    }
}
