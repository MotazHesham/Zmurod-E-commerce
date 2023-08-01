<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPostsTable extends Migration
{
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('post_forum_id')->nullable();
            $table->foreign('post_forum_id', 'post_forum_fk_8640279')->references('id')->on('froums');
            $table->unsignedBigInteger('author_id')->nullable();
            $table->foreign('author_id', 'author_fk_8640280')->references('id')->on('users');
            $table->unsignedBigInteger('tags_id')->nullable();
            $table->foreign('tags_id', 'tags_fk_8821399')->references('id')->on('tags');
        });
    }
}