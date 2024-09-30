<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogCommentPivotTable extends Migration
{
    public function up()
    {
        Schema::create('blog_comment', function (Blueprint $table) {
            $table->unsignedBigInteger('blog_id');
            $table->foreign('blog_id', 'blog_id_fk_8662416')->references('id')->on('blogs')->onDelete('cascade');
            $table->unsignedBigInteger('comment_id');
            $table->foreign('comment_id', 'comment_id_fk_8662416')->references('id')->on('comments')->onDelete('cascade');
        });
    }
}
