<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToReviewsTable extends Migration
{
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->unsignedBigInteger('user_review_id')->nullable();
            $table->foreign('user_review_id', 'user_review_fk_8640580')->references('id')->on('users');
            $table->unsignedBigInteger('product_review_id')->nullable();
            $table->foreign('product_review_id', 'product_review_fk_8640581')->references('id')->on('products');
        });
    }
}
