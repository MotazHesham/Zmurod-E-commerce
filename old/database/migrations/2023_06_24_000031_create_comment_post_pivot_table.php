<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentPostPivotTable extends Migration
{
    public function up()
    {
        Schema::create('comment_post', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id');
            $table->foreign('post_id', 'post_id_fk_8640574')->references('id')->on('posts')->onDelete('cascade');
            $table->unsignedBigInteger('comment_id');
            $table->foreign('comment_id', 'comment_id_fk_8640574')->references('id')->on('comments')->onDelete('cascade');
        });
    }
}
