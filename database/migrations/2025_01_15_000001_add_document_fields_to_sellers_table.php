<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDocumentFieldsToSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sellers', function (Blueprint $table) {
            $table->enum('document_type', ['commercial_register', 'freelance_work'])->nullable();
            $table->string('commercial_register_document')->nullable();
            $table->date('commercial_register_expiry')->nullable();
            $table->string('commercial_register_number')->nullable();
            $table->string('tax_number')->nullable();
            $table->string('freelance_work_document')->nullable();
            $table->string('freelance_work_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sellers', function (Blueprint $table) {
            $table->dropColumn([
                'document_type',
                'commercial_register_document',
                'commercial_register_expiry',
                'commercial_register_number',
                'tax_number',
                'freelance_work_document',
                'freelance_work_number'
            ]);
        });
    }
}
