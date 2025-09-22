<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDownloadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_downloads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_content_id')->constrained()->onDelete('cascade');
            $table->string('download_type')->default('video'); // video, audio, pdf, etc.
            $table->string('file_path')->nullable(); // path to downloaded file
            $table->string('file_size')->nullable(); // file size in bytes
            $table->string('download_method')->default('direct'); // direct, stream, zip
            $table->ipAddress('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamp('downloaded_at')->useCurrent();
            $table->timestamps();
            
            // Indexes for better performance
            $table->index(['user_id', 'course_content_id']);
            $table->index('downloaded_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_downloads');
    }
}
